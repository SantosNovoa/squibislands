<?php

namespace App\Models\User;

<<<<<<< HEAD
use App\Models\Currency\Currency;
use App\Models\Model;

class UserCurrency extends Model {
=======
use App\Models\Model;

class UserCurrency extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'quantity', 'user_id', 'currency_id',
    ];

=======
        'quantity', 'user_id', 'currency_id'
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Accessors to append to the model.
     *
     * @var array
     */
    protected $appends = [
<<<<<<< HEAD
        'name_with_quantity',
=======
        'name_with_quantity'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_currencies';

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who owns the currency.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class);
=======
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the currency associated with this record.
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
     * Displays the currency's name and owned quantity.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getNameWithQuantityAttribute() {
        return $this->currency->name.' [Owned: '.$this->quantity.']';
=======
    public function getNameWithQuantityAttribute()
    {
        return $this->currency->name . ' [Owned: ' . $this->quantity . ']';
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
