<?php

namespace App\Helpers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Config;

class MailHelper
{
    public static function setMailConfig()
    {
        Config::set('mail.mailers.smtp.host', SiteSetting::get('mail_host', config('mail.mailers.smtp.host')));
        Config::set('mail.mailers.smtp.port', SiteSetting::get('mail_port', config('mail.mailers.smtp.port')));
        Config::set('mail.mailers.smtp.username', SiteSetting::get('mail_username', config('mail.mailers.smtp.username')));
        Config::set('mail.mailers.smtp.password', SiteSetting::get('mail_password', config('mail.mailers.smtp.password')));
        Config::set('mail.mailers.smtp.encryption', SiteSetting::get('mail_encryption', config('mail.mailers.smtp.encryption')));
        Config::set('mail.from.address', SiteSetting::get('mail_from_address', config('mail.from.address')));
        Config::set('mail.from.name', SiteSetting::get('mail_from_name', config('mail.from.name')));
    }
}
