<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || env('APP_ENV') === 'production' || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Load Mail Settings from Database
        try {
            if (class_exists(\App\Models\SiteSetting::class)) {
                $settings = \App\Models\SiteSetting::where('key', 'like', 'mail_%')->get()->pluck('value', 'key');
                
                if ($settings->isNotEmpty()) {
                    config([
                        'mail.mailers.smtp.host' => $settings->get('mail_host'),
                        'mail.mailers.smtp.port' => $settings->get('mail_port'),
                        'mail.mailers.smtp.username' => $settings->get('mail_username'),
                        'mail.mailers.smtp.password' => $settings->get('mail_password'),
                        'mail.mailers.smtp.encryption' => $settings->get('mail_encryption'),
                        'mail.from.address' => $settings->get('mail_from_address'),
                        'mail.from.name' => $settings->get('mail_from_name'),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Avoid crash during migration
        }
    }
}
