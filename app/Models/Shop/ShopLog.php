<?php

namespace App\Models\Shop;

<<<<<<< HEAD
use App\Models\Character\Character;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\Model;
use App\Models\User\User;

class ShopLog extends Model {
=======
use App\Models\Model;

class ShopLog extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'shop_id', 'character_id', 'user_id', 'currency_id', 'cost', 'item_id', 'quantity',
=======
        'shop_id', 'character_id', 'user_id', 'currency_id', 'cost', 'item_id', 'quantity'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_log';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'stock_id' => 'required',
<<<<<<< HEAD
        'shop_id'  => 'required',
        'bank'     => 'required|in:user,character',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who purchased the item.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the character who purchased the item.
     */
    public function character() {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the purchased item.
     */
    public function item() {
        return $this->belongsTo(Item::class);
=======
        'shop_id' => 'required',
        'bank' => 'required|in:user,character'
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the user who purchased the item.
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
    }
    
    /**
     * Get the character who purchased the item.
     */
    public function character() 
    {
        return $this->belongsTo('App\Models\Character\Character');
    }
    /**
     * Get the purchased item.
     */
    public function item() 
    {
        return $this->belongsTo('App\Models\Item\Item');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the shop the item was purchased from.
     */
<<<<<<< HEAD
    public function shop() {
        return $this->belongsTo(Shop::class);
=======
    public function shop() 
    {
        return $this->belongsTo('App\Models\Shop\Shop');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the currency used to purchase the item.
     */
<<<<<<< HEAD
    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    /**********************************************************************************************

=======
    public function currency() 
    {
        return $this->belongsTo('App\Models\Currency\Currency');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the item data that will be added to the stack as a record of its source.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getItemDataAttribute() {
        return 'Purchased from '.$this->shop->name.' by '.($this->character_id ? $this->character->slug.' (owned by '.$this->user->name.')' : $this->user->displayName).' for '.(int) $this->cost.' '.$this->currency->name.'.';
=======
    public function getItemDataAttribute()
    {
        return 'Purchased from '.$this->shop->name.' by '.($this->character_id ? $this->character->slug . ' (owned by ' . $this->user->name . ')' : $this->user->displayName) . ' for ' . $this->cost . ' ' . $this->currency->name . '.';
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
