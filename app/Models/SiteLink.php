<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class SiteLink extends Model
{
    protected $table = 'site_links';

    protected $fillable = ['key', 'url'];

    public $timestamps = true;

    /**
     * Get a link by key. Cached so the navbar doesn't query on every page load.
     */
    public static function url($key)
    {
        return Cache::rememberForever('site_link_'.$key, function () use ($key) {
            return static::where('key', $key)->value('url');
        });
    }

    /**
     * Update a link and clear its cache.
     */
    public static function setUrl($key, $url)
    {
        static::updateOrCreate(['key' => $key], ['url' => $url]);
        Cache::forget('site_link_'.$key);
    }
}