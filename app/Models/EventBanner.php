<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class EventBanner extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'link', 'show_name', 'is_active', 'sort', 'hash', 'extension',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_banners';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'show_name' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'name'  => 'required|between:2,100',
        'link'  => 'nullable|string|max:255',
        'sort'  => 'nullable|integer|min:0',
        'image' => 'required|mimes:png,jpg,jpeg,gif,webp|max:4096',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'name'  => 'required|between:2,100',
        'link'  => 'nullable|string|max:255',
        'sort'  => 'nullable|integer|min:0',
        'image' => 'nullable|mimes:png,jpg,jpeg,gif,webp|max:4096',
    ];

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Banners that are switched on and actually have an image.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query) {
        return $query->where('is_active', 1)->whereNotNull('hash');
    }

    /**
     * Higher sort shows first (matches Lorekeeper's convention), newest breaks ties.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query) {
        return $query->orderBy('sort', 'DESC')->orderBy('id', 'DESC');
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Public-relative directory for banner images.
     *
     * @return string
     */
    public function getImageDirectoryAttribute() {
        return 'images/data/event-banners';
    }

    /**
     * Absolute path to the banner image directory.
     *
     * @return string
     */
    public function getImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

    /**
     * Banner image file name. The hash changes on every upload, so browsers never serve a stale copy.
     *
     * @return string|null
     */
    public function getImageFileNameAttribute() {
        if (!$this->hash || !$this->extension) {
            return null;
        }

        return $this->id.'-'.$this->hash.'.'.$this->extension;
    }

    /**
     * Banner image URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute() {
        if (!$this->imageFileName) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->imageFileName);
    }

    /**
     * Link target. Accepts full URLs (https://...) or site-relative paths (events/hollow-een).
     *
     * @return string|null
     */
    public function getLinkUrlAttribute() {
        if (!$this->link) {
            return null;
        }

        return preg_match('#^https?://#i', $this->link) ? $this->link : url($this->link);
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Whether the global dashboard toggle is on.
     *
     * @return bool
     */
    public static function isEnabled() {
        return (bool) DB::table('site_settings')->where('key', 'event_banner_enabled')->value('value');
    }

    /**
     * Banners to show on the dashboard. Empty if the global toggle is off.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function forDashboard() {
        if (!static::isEnabled()) {
            return collect();
        }

        return static::visible()->sorted()->get();
    }

    /**
     * The dashboard shortcuts (config/lorekeeper/dashboard_shortcuts.php) with their on/off state.
     * A shortcut with no setting row yet (migration not run) counts as active, so nothing vanishes unexpectedly.
     *
     * @param bool $activeOnly
     *
     * @return \Illuminate\Support\Collection keyed by shortcut key
     */
    public static function dashboardShortcuts($activeOnly = true) {
        $settings = DB::table('site_settings')->where('key', 'like', 'dashboard_shortcut_%_active')->pluck('value', 'key');

        $shortcuts = collect(config('lorekeeper.dashboard_shortcuts', []))->map(function ($shortcut, $key) use ($settings) {
            $shortcut['key'] = $key;
            $shortcut['is_active'] = (bool) ($settings['dashboard_shortcut_'.$key.'_active'] ?? 1);

            return $shortcut;
        });

        return $activeOnly ? $shortcuts->filter(fn ($shortcut) => $shortcut['is_active']) : $shortcuts;
    }
}
