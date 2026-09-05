<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $days = (int) $request->get('days', 7);
        $startDate = now()->subDays($days);

        $stats = [
            'total_users' => User::count(),
            'total_cards' => BusinessCard::count(),
            'shared_cards' => BusinessCard::where('is_active', true)
                ->whereHas('user', function($q) { $q->where('is_active', true); })
                ->where('view_count', '>', 0)->count(),
            'total_views' => \DB::table('card_views')->count(),
        ];

        // Calculate percentages (compared to previous period)
        $prevTotalUsers = User::where('created_at', '<', $startDate)->count();
        $stats['user_change'] = $prevTotalUsers > 0 ? round((($stats['total_users'] - $prevTotalUsers) / $prevTotalUsers) * 100, 1) : 0;
        $stats['share_ratio'] = $stats['total_cards'] > 0 ? round(($stats['shared_cards'] / $stats['total_cards']) * 100, 1) : 0;
        
        $recentUsers = User::latest()->take(6)->get();
        $recentCards = BusinessCard::with('user')->latest()->take(6)->get();

        // Chart data for activity
        $activity = [
            'labels' => [],
            'users' => [],
            'cards' => [],
            'views' => []
        ];
        
        for($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateStr = $date->format('Y-m-d');
            $activity['labels'][] = $date->format('d/m');
            $activity['users'][] = User::whereDate('created_at', $dateStr)->count();
            $activity['cards'][] = BusinessCard::whereDate('created_at', $dateStr)->count();
            $activity['views'][] = \DB::table('card_views')->whereDate('created_at', $dateStr)->count();
        }
        
        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentCards', 'days', 'activity'));
    }

    public function exportUsers()
    {
        $users = User::all();
        $csvHeader = ['ID', 'Name', 'Email', 'Role', 'Status', 'Created At'];
        $handle = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users.csv"');
        fputcsv($handle, $csvHeader);
        foreach ($users as $user) {
            fputcsv($handle, [
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->is_active ? 'Active' : 'Locked',
                $user->created_at
            ]);
        }
        fclose($handle);
        exit;
    }

    public function exportCards()
    {
        $cards = BusinessCard::with('user')->get();
        $csvHeader = ['ID', 'Full Name', 'Job Title', 'Company', 'Owner Email', 'Views', 'Created At'];
        $handle = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="cards.csv"');
        fputcsv($handle, $csvHeader);
        foreach ($cards as $card) {
            fputcsv($handle, [
                $card->id,
                $card->full_name,
                $card->job_title,
                $card->company,
                $card->user->email ?? 'N/A',
                $card->view_count,
                $card->created_at
            ]);
        }
        fclose($handle);
        exit;
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('is_active', $request->status === 'active' ? 1 : 0);
        }

        $perPage = $request->get('per_page', 10);
        $users = $query->paginate($perPage)->withQueryString();
        return view('admin.users', compact('users'));
    }

    public function cards(Request $request)
    {
        $query = BusinessCard::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } else {
                $query->where('is_active', false);
            }
        }

        $perPage = $request->get('per_page', 10);
        $cards = $query->latest()->paginate($perPage)->withQueryString();
        return view('admin.cards', compact('cards'));
    }

    public function statistics(Request $request)
    {
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));

        $stats = [
            'total_users' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_cards' => BusinessCard::whereBetween('created_at', [$startDate, $endDate])->count(),
            'shared_cards' => BusinessCard::where('is_active', true)
                ->whereHas('user', function($q) { $q->where('is_active', true); })
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('view_count', '>', 0)->count(),
            'total_views' => BusinessCard::whereBetween('created_at', [$startDate, $endDate])->sum('view_count'),
        ];

        // Fetch daily breakdown for the table
        $dailyStats = BusinessCard::selectRaw('DATE(created_at) as date, count(*) as cards_count, sum(view_count) as views_count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->paginate(5, ['*'], 'daily_page')
            ->withQueryString();

        return view('admin.statistics', compact('stats', 'dailyStats'));
    }

    public function editUser(User $user)
    {
        return view('admin.users_edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => ['required', 'string', 'regex:/^(0|\+84)[3|5|7|8|9][0-9]{8}$/', Rule::unique('users', 'phone')->ignore($user->id)],
            'role' => 'required|in:user,admin',
            'is_active' => 'required|boolean',
        ]);

        $user->update($validated);
        return redirect()->route('admin.users')->with('success', 'Cập nhật người dùng thành công!');
    }

    public function toggleUserStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Không thể thay đổi trạng thái của chính mình.');
        }
        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success', 'Đã cập nhật trạng thái người dùng.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Không thể xóa chính mình.');
        }
        $user->delete();
        return back()->with('success', 'Đã xóa người dùng.');
    }

    public function destroyCard(BusinessCard $card)
    {
        $card->delete();
        return back()->with('success', 'Đã xóa danh thiếp.');
    }
}
