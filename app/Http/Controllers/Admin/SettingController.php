<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $keys = ['hero_image','hero_profile','hero_screen','company_name','hotline','email','address','support_name','support_phone','support_zalo','support_avatar','hero_title','hero_desc','facebook_page_url','mail_host','mail_port','mail_username','mail_password','mail_encryption','mail_from_address','mail_from_name','site_logo','payment_bank_name','payment_account_number','payment_account_name','payment_transfer_content','payment_qr_code'];
        $settings = [];
        foreach ($keys as $key) {
            $settings[$key] = SiteSetting::get($key);
        }
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        // Hero image
        if ($request->hasFile('hero_image_file')) {
            $path = $request->file('hero_image_file')->store('public/settings');
            SiteSetting::set('hero_image', Storage::url($path));
        } elseif ($request->filled('hero_image_url')) {
            SiteSetting::set('hero_image', $request->hero_image_url);
        }

        // Hero Profile
        if ($request->hasFile('hero_profile_file')) {
            $path = $request->file('hero_profile_file')->store('public/settings');
            SiteSetting::set('hero_profile', Storage::url($path));
        } elseif ($request->filled('hero_profile_url')) {
            SiteSetting::set('hero_profile', $request->hero_profile_url);
        }

        // Hero Screen
        if ($request->hasFile('hero_screen_file')) {
            $path = $request->file('hero_screen_file')->store('public/settings');
            SiteSetting::set('hero_screen', Storage::url($path));
        } elseif ($request->filled('hero_screen_url')) {
            SiteSetting::set('hero_screen', $request->hero_screen_url);
        }

        // Support avatar
        if ($request->hasFile('support_avatar_file')) {
            $path = $request->file('support_avatar_file')->store('public/settings');
            SiteSetting::set('support_avatar', Storage::url($path));
        }

        // Site logo
        if ($request->hasFile('site_logo_file')) {
            $path = $request->file('site_logo_file')->store('public/settings');
            SiteSetting::set('site_logo', Storage::url($path));
        } elseif ($request->filled('site_logo_url')) {
            SiteSetting::set('site_logo', $request->site_logo_url);
        }

        // Payment QR Code
        if ($request->hasFile('payment_qr_code_file')) {
            $path = $request->file('payment_qr_code_file')->store('public/settings');
            SiteSetting::set('payment_qr_code', Storage::url($path));
        }

        // Text fields
        $textFields = ['company_name','hotline','email','address','support_name','support_phone','support_zalo','hero_title','hero_desc','facebook_page_url','mail_host','mail_port','mail_username','mail_password','mail_encryption','mail_from_address','mail_from_name','payment_bank_name','payment_account_number','payment_account_name','payment_transfer_content'];
        foreach ($textFields as $field) {
            if ($request->filled($field)) {
                SiteSetting::set($field, $request->input($field));
            }
        }

        return back()->with('success', 'Cập nhật cấu hình thành công!');
    }
}
