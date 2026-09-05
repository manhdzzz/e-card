<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'regex:/^(0|\+84)[3|5|7|8|9][0-9]{8}$/', 'unique:users,phone'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'account_type' => ['required', 'in:personal,enterprise'],
            
            // Enterprise fields
            'company_name' => ['required_if:account_type,enterprise', 'nullable', 'string', 'max:255'],
            'tax_code' => ['nullable', 'string', 'max:50'],
            'company_phone' => ['nullable', 'string', 'unique:companies,phone'],
            
            // Card info
            'job' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'introduce' => ['required', 'string'],
        ], [
            'phone.regex' => 'Số điện thoại không đúng định dạng Việt Nam.',
            'phone.unique' => 'Số điện thoại này đã được đăng ký.',
            'email.unique' => 'Địa chỉ email này đã được đăng ký.',
            'company_phone.unique' => 'Số điện thoại doanh nghiệp này đã tồn tại.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type,
            'role' => $request->account_type === 'enterprise' ? 'enterprise_admin' : 'user',
        ]);

        if ($request->account_type === 'enterprise') {
            $company = \App\Models\Company::create([
                'name' => $request->company_name,
                'tax_code' => $request->tax_code,
                'address' => $request->company_address,
                'phone' => $request->company_phone,
                'owner_id' => $user->id,
            ]);

            $user->update(['company_id' => $company->id]);
        }

        // Create initial business card
        $slug = \Illuminate\Support\Str::slug($request->name);
        // Check if slug exists
        $originalSlug = $slug;
        $count = 1;
        while (\App\Models\BusinessCard::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        \App\Models\BusinessCard::create([
            'user_id' => $user->id,
            'full_name' => $request->name,
            'job_title' => $request->job,
            'bio' => $request->introduce,
            'company' => $request->company,
            'brand_name' => $request->brandname,
            'phone' => $request->phone,
            'email' => $request->email,
            'slug' => $slug,
            'is_active' => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Đăng ký tài khoản thành công!');
    }
}
