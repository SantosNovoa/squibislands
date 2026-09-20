<?php

namespace App\Models\Sales;

<<<<<<< HEAD
use App\Models\Character\Character;
use App\Models\Character\CharacterImage;
use App\Models\Model;

class SalesCharacter extends Model {
=======
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Character\CharacterImage;

use App\Models\Model;

class SalesCharacter extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'sales_id', 'character_id', 'image_id', 'description', 'type', 'data', 'link', 'is_open',
=======
        'sales_id', 'character_id', 'description', 'type', 'data', 'link', 'is_open'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_characters';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
<<<<<<< HEAD
        'type'          => 'required',
        'link'          => 'nullable|url',

        // Flatsale
        'price'         => 'required_if:sale_type,flat',

        // Auction/XTA
        'starting_bid'  => 'required_if:type,auction',
        'min_increment' => 'required_if:type,auction',
        'end_point'     => 'exclude_unless:type,auction,xta,ota|max:255',
=======
        'type' => 'required',
        'link' => 'nullable|url',

        // Flatsale
        'price' => 'required_if:sale_type,flat',

        // Auction/XTA
        'starting_bid' => 'required_if:type,auction',
        'min_increment' => 'required_if:type,auction',
        'end_point' => 'exclude_unless:type,auction,xta,ota|max:255'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the sale this is attached to.
     */
<<<<<<< HEAD
    public function sales() {
        return $this->belongsTo(Sales::class, 'sales_id');
=======
    public function sales()
    {
        return $this->belongsTo('App\Models\Sales\Sales', 'sales_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the character being attached to the sale.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class, 'character_id')->withTrashed();
    }

    /**
     * Get the image being attached to the sale.
     */
    public function image() {
        return $this->belongsTo(CharacterImage::class, 'image_id');
=======
    public function character()
    {
        return $this->belongsTo('App\Models\Character\Character', 'character_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the data attribute as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getDataAttribute() {
=======
    public function getDataAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->attributes['data'], true);
    }

    /**
     * Get the data attribute as an associative array.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayTypeAttribute() {
        switch ($this->attributes['type']) {
=======
    public function getDisplayTypeAttribute()
    {
        switch($this->attributes['type']) {
>>>>>>> Cylunny/extension/polls-and-forms
            case 'flatsale':
                return 'Flatsale';
                break;
            case 'auction':
                return 'Auction';
                break;
            case 'ota':
                return 'OTA';
                break;
            case 'xta':
                return 'XTA';
                break;
            case 'flaffle':
                return 'Flatsale Raffle';
                break;
            case 'raffle':
                return 'Raffle';
                break;
            case 'pwyw':
                return 'PWYW';
                break;
        }
    }

    /**
     * Get the data attribute as an associative array.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getTypeLinkAttribute() {
        switch ($this->attributes['type']) {
=======
    public function getTypeLinkAttribute()
    {
        switch($this->attributes['type']) {
>>>>>>> Cylunny/extension/polls-and-forms
            case 'flatsale':
                return 'Claim Here';
                break;
            case 'auction':
                return 'Bid Here';
                break;
            case 'ota':
                return 'Offer Here';
                break;
            case 'xta':
                return 'Enter Here';
                break;
            case 'flaffle':
                return 'Enter Here';
                break;
            case 'raffle':
                return 'Enter Here';
                break;
            case 'pwyw':
                return 'Claim Here';
                break;
        }
    }

    /**
     * Get formatted pricing information.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getPriceAttribute() {
        if ($this->type == 'raffle') {
            return null;
        }
        $symbol = config('lorekeeper.settings.currency_symbol');

        switch ($this->type) {
=======
    public function getPriceAttribute()
    {
        if($this->type == 'raffle') return null;
        $symbol = Config::get('lorekeeper.settings.currency_symbol');

        switch($this->type) {
>>>>>>> Cylunny/extension/polls-and-forms
            case 'flatsale':
                return 'Price: '.$symbol.$this->data['price'];
                break;
            case 'auction':
                return 'Starting Bid: '.$symbol.$this->data['starting_bid'].'<br/>'.
                'Minimum Increment: '.$symbol.$this->data['min_increment'].
<<<<<<< HEAD
                (isset($this->data['autobuy']) ? '<br/>Autobuy: '.$symbol.$this->data['autobuy'] : '');
                break;
            case 'ota':
                return (isset($this->data['autobuy']) ? 'Autobuy: '.$symbol.$this->data['autobuy'].'<br/>' : '').
                (isset($this->data['minimum']) ? 'Minimum: '.$symbol.$this->data['minimum'].'<br/>' : '');
                break;
            case 'xta':
                return (isset($this->data['autobuy']) ? 'Autobuy: '.$symbol.$this->data['autobuy'].'<br/>' : '').
                (isset($this->data['minimum']) ? 'Minimum: '.$symbol.$this->data['minimum'].'<br/>' : '');
=======
                (isset($this->data['autobuy']) ? '<br/>Autobuy: '.$symbol.$this->data['autobuy'] : '')
                ;
                break;
            case 'ota':
                return (isset($this->data['autobuy']) ? 'Autobuy: '.$symbol.$this->data['autobuy'].'<br/>' : '').
				(isset($this->data['minimum']) ? 'Minimum: '.$symbol.$this->data['minimum'].'<br/>' : '');
                break;
            case 'xta':
                return (isset($this->data['autobuy']) ? 'Autobuy: '.$symbol.$this->data['autobuy'].'<br/>' : '').
				(isset($this->data['minimum']) ? 'Minimum: '.$symbol.$this->data['minimum'].'<br/>' : '');
>>>>>>> Cylunny/extension/polls-and-forms
                break;
            case 'flaffle':
                return 'Price: '.$symbol.$this->data['price'];
                break;
            case 'pwyw':
<<<<<<< HEAD
                return isset($this->data['minimum']) ? 'Minimum: '.$symbol.$this->data['minimum'].'<br/>' : '';
=======
                return (isset($this->data['minimum']) ? 'Minimum: '.$symbol.$this->data['minimum'].'<br/>' : '');
>>>>>>> Cylunny/extension/polls-and-forms
                break;
        }
    }

    /**
     * Get the first image for the associated character.
     *
     * @return App\Models\Character\CharacterImage
     */
<<<<<<< HEAD
    public function getImageAttribute() {
        // Have to call the relationship function or it doesn't grab it correctly
        // likely because of the function name override
        return $this->image()->first() ?? CharacterImage::where('is_visible', 1)->where('character_id', $this->character_id)->orderBy('created_at')->first();
    }
=======
    public function getImageAttribute()
    {
        return CharacterImage::where('is_visible', 1)->where('character_id', $this->character_id)->orderBy('created_at')->first();
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
