<?php

namespace App\Models\CustomArtist;

use App\Models\Model;
use App\Models\User\User;

class CustomArtistProfile extends Model {
    /**
     * The kinds of work an artist can open, keyed by the value stored in the database.
     */
    public const TYPES = [
        'custom'   => 'Custom',
        'rebase'   => 'Rebase',
        'redesign' => 'Redesign',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'is_active', 'is_custom_open', 'is_rebase_open', 'is_redesign_open',
        'contacts', 'notes', 'parsed_notes',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_artist_profiles';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active'        => 'boolean',
        'is_custom_open'   => 'boolean',
        'is_rebase_open'   => 'boolean',
        'is_redesign_open' => 'boolean',
        'contacts'         => 'array', // [['site' => 'Toyhou.se', 'url' => 'https://...'], ...]
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * The artist this entry belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * All options on this entry.
     */
    public function options() {
        return $this->hasMany(CustomArtistOption::class, 'profile_id')->orderBy('sort');
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Whether a type (custom / rebase / redesign) is toggled open.
     *
     * @param string $type
     *
     * @return bool
     */
    public function isTypeOpen($type) {
        return (bool) $this->{'is_'.$type.'_open'};
    }

    /**
     * Active options for one type, in the artist's order.
     *
     * @param string $type
     *
     * @return \Illuminate\Support\Collection
     */
    public function activeOptions($type) {
        return $this->options->where('type', $type)->where('is_active', 1)->sortBy('sort');
    }

    /**
     * Types that are open and have at least one active option.
     *
     * @return array
     */
    public function openTypes() {
        return collect(self::TYPES)
            ->filter(fn ($label, $key) => $this->isTypeOpen($key) && $this->activeOptions($key)->count())
            ->all();
    }

    /**
     * Entries to show on the Official Customs page: active, still allowed,
     * and with at least one open type.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function visibleOnPage() {
        return static::where('is_active', 1)
            ->with(['user.rank', 'options.currency'])
            ->get()
            ->filter(fn ($profile) => $profile->user
                && CustomArtistAccess::userCanEdit($profile->user)
                && count($profile->openTypes()))
            ->sortBy(fn ($profile) => strtolower($profile->user->name))
            ->values();
    }
}
