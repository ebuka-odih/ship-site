<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Get multiple settings at once
     */
    public static function getMany($keys)
    {
        return static::whereIn('key', $keys)->pluck('value', 'key')->toArray();
    }

    /**
     * Set multiple settings at once
     */
    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            static::set($key, $value);
        }
    }
}
