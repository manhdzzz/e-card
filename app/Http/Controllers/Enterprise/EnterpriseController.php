<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\BusinessCard;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    private function getCompany()
    {
        return auth()->user()->ownedCompany ?? auth()->user()->company;
    }

    public function dashboard()
    {
        $company = $this->getCompany();
        if (!$company) return redirect('/')->with('error', 'Bạn chưa có doanh nghiệp nào.');

        $stats = [
            'departments' => $company->departments()->count(),
            'employees' => $company->employees()->count(),
            'active_employees' => $company->employees()->where('is_active', true)->count(),
            'cards' => BusinessCard::whereIn('user_id', $company->members()->pluck('id'))->count(),
            'total_views' => BusinessCard::whereIn('user_id', $company->members()->pluck('id'))->sum('view_count'),
        ];

        $recentEmployees = $company->employees()->with('department')->latest()->take(5)->get();

        return view('enterprise.dashboard', compact('company', 'stats', 'recentEmployees'));
    }

    public function cards()
    {
        $company = $this->getCompany();
        $cards = BusinessCard::whereIn('user_id', $company->members()->pluck('id'))
            ->with('user')
            ->latest()
            ->paginate(12);

        return view('enterprise.cards', compact('company', 'cards'));
    }

    public function statistics(Request $request)
    {
        $company = $this->getCompany();
        $memberIds = $company->members()->pluck('id');
        $cardIds = \App\Models\BusinessCard::whereIn('user_id', $memberIds)->pluck('id');

        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        // Views in date range
        $viewCountInRange = \Illuminate\Support\Facades\DB::table('card_views')
            ->whereIn('card_id', $cardIds)
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->count();

        // New cards in date range
        $newCardsInRange = \App\Models\BusinessCard::whereIn('user_id', $memberIds)
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->count();

        $stats = [
            'total_cards' => \App\Models\BusinessCard::whereIn('user_id', $memberIds)->count(),
            'active_cards' => \App\Models\BusinessCard::whereIn('user_id', $memberIds)->where('is_active', true)->count(),
            'total_views' => \App\Models\BusinessCard::whereIn('user_id', $memberIds)->sum('view_count'),
            'view_count_range' => $viewCountInRange,
            'new_cards_range' => $newCardsInRange,
            'departments' => $company->departments()->withCount('employees')->get(),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];

        return view('enterprise.statistics', compact('company', 'stats'));
    }

    public function settings()
    {
        $company = $this->getCompany();
        return view('enterprise.settings', compact('company'));
    }

    public function updateSettings(Request $request)
    {
        $company = $this->getCompany();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tax_code' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('companies', 'public');
        }

        $company->update($validated);

        return back()->with('success', 'Cập nhật thông tin doanh nghiệp thành công!');
    }
}
