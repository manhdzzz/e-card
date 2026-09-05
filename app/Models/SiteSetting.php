<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value'];

    protected static $cachedSettings = null;

    public static function get($key, $default = null)
    {
        if (self::$cachedSettings === null) {
            try {
                self::$cachedSettings = self::pluck('value', 'key')->all();
            } catch (\Exception $e) {
                self::$cachedSettings = [];
            }
        }

        return self::$cachedSettings[$key] ?? $default;
    }

    public static function set($key, $value)
    {
        self::$cachedSettings = null;
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
