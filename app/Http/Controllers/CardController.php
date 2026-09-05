<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CardController extends Controller
{
    public function index()
    {
        $cards = Auth::user()->cards;
        return view('cards.index', compact('cards'));
    }

    public function create()
    {
        $isEnterpriseEmployee = auth()->user()->account_type === 'enterprise' && auth()->user()->employee;
        return view('cards.create', compact('isEnterpriseEmployee'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $isEnterpriseEmployee = $user->account_type === 'enterprise' && $user->employee;

        $validated = $request->validate([
            'full_name' => $isEnterpriseEmployee ? 'nullable' : 'required|string|max:255',
            'job_title' => $isEnterpriseEmployee ? 'nullable' : 'nullable|string|max:255',
            'company' => $isEnterpriseEmployee ? 'nullable' : 'nullable|string|max:255',
            'phone' => [
    'nullable',
    'string',
    'regex:/^(0|\+84)[35789][0-9]{8}$/',
],
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'zalo_url' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($isEnterpriseEmployee) {
            $employee = $user->employee;
            $validated['full_name'] = $employee->full_name;
            $validated['job_title'] = $employee->position;
            $validated['company'] = $employee->company->name;
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        // Sanitize URLs
        foreach(['website', 'facebook_url', 'linkedin_url', 'zalo_url'] as $field) {
            if (!empty($validated[$field]) && !preg_match("~^(?:f|ht)tps?://~i", $validated[$field])) {
                $validated[$field] = "https://" . $validated[$field];
            }
        }

        $card = new BusinessCard($validated);
        $card->user_id = Auth::id();
        $card->slug = Str::slug($validated['full_name']) . '-' . Str::random(5);
        $card->save();

        return redirect()->route('cards.index')->with('success', 'Danh thiếp đã được tạo!');
    }

    public function show($slug)
    {
        $card = BusinessCard::where('slug', $slug)
            ->where('is_active', true)
            ->whereHas('user', function($query) {
                $query->where('is_active', true);
            })
            ->firstOrFail();

        $this->recordView($card);

        return view('cards.public', compact('card'));
    }

    private function recordView($card)
    {
        $ip = request()->header('X-Forwarded-For') ?: request()->ip();
        
        $recentView = \DB::table('card_views')
            ->where('card_id', $card->id)
            ->where('ip_address', $ip)
            ->where('created_at', '>', now()->subMinutes(15))
            ->first();

        if (!$recentView) {
            \DB::table('card_views')->insert([
                'card_id' => $card->id,
                'ip_address' => $ip,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $card->increment('view_count');
            $card->refresh(); 
        }
    }

    public function edit(BusinessCard $card)
    {
        $this->authorize('update', $card);
        $isEnterpriseEmployee = auth()->user()->account_type === 'enterprise' && auth()->user()->employee;
        return view('cards.edit', compact('card', 'isEnterpriseEmployee'));
    }

    public function update(Request $request, BusinessCard $card)
    {
        $this->authorize('update', $card);
        $user = auth()->user();
        $isEnterpriseEmployee = $user->account_type === 'enterprise' && $user->employee;

        $validated = $request->validate([
            'full_name' => $isEnterpriseEmployee ? 'nullable' : 'required|string|max:255',
            'job_title' => $isEnterpriseEmployee ? 'nullable' : 'nullable|string|max:255',
            'company' => $isEnterpriseEmployee ? 'nullable' : 'nullable|string|max:255',
            'phone' => [
    'nullable',
    'string',
    'regex:/^(0|\+84)[35789][0-9]{8}$/',
],
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'zalo_url' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($isEnterpriseEmployee) {
            $employee = $user->employee;
            $validated['full_name'] = $employee->full_name;
            $validated['job_title'] = $employee->position;
            $validated['company'] = $employee->company->name;
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        // Sanitize URLs
        foreach(['website', 'facebook_url', 'linkedin_url', 'zalo_url'] as $field) {
            if (!empty($validated[$field]) && !preg_match("~^(?:f|ht)tps?://~i", $validated[$field])) {
                $validated[$field] = "https://" . $validated[$field];
            }
        }

        $card->update($validated);

        return redirect()->route('cards.index')->with('success', 'Danh thiếp đã được cập nhật!');
    }

    public function destroy(BusinessCard $card)
    {
        $this->authorize('delete', $card);
        $card->delete();
        return redirect()->route('cards.index')->with('success', 'Danh thiếp đã bị xóa!');
    }

    public function share(BusinessCard $card)
    {
        $this->authorize('view', $card);
        return view('cards.share', compact('card'));
    }

    public function detail(BusinessCard $card)
    {
        // Check if owner is active and card is active
        if (!$card->user->is_active || !$card->is_active) {
            abort(404);
        }

        $this->recordView($card);
        return view('cards.detail', compact('card'));
    }
}
