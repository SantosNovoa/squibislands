<?php

namespace App\Models\CustomArtist;

use App\Models\Currency\Currency;
use App\Models\Model;

class CustomArtistOption extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id', 'type', 'name', 'price', 'currency_id', 'is_active', 'sort',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_artist_options';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * The entry this option belongs to.
     */
    public function profile() {
        return $this->belongsTo(CustomArtistProfile::class, 'profile_id');
    }

    /**
     * The site currency the price is in. Null means USD.
     */
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Price formatted for display, e.g. "$45", "$12.50" or the site currency's own display.
     *
     * @return string
     */
    public function getDisplayPriceAttribute() {
        $price = (float) $this->price;

        if ($this->currency) {
            return $this->currency->display((int) $price);
        }

        return '$'.number_format($price, fmod($price, 1) == 0.0 ? 0 : 2);
    }
}
