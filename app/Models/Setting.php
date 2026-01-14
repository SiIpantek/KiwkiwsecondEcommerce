<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get setting value by key
     */
    public static function getValue($key, $default = null)
    {
        try {
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Exception $e) {
            // Jika tabel belum ada atau error, return default
            return $default;
        }
    }

    /**
     * Set setting value by key
     */
    public static function setValue($key, $value)
    {
        try {
            return self::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        } catch (\Exception $e) {
            // Jika tabel belum ada, return false
            return false;
        }
    }
}
