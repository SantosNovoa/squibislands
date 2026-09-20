<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Currency\Currency;
use App\Models\Model;

class CharacterCurrency extends Model {
=======
use App\Models\Model;

class CharacterCurrency extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'quantity', 'character_id', 'currency_id',
    ];

=======
        'quantity', 'character_id', 'currency_id'
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_currencies';

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character the record belongs to.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the currency associated with this record.
     */
    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    /**********************************************************************************************

=======
    public function character() 
    {
        return $this->belongsTo('App\Models\Character\Character');
    }
    
    /**
     * Get the currency associated with this record.
     */
    public function currency() 
    {
        return $this->belongsTo('App\Models\Currency\Currency');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the name of the currency formatted with the quantity owned.
<<<<<<< HEAD
     *
     * @return string
     */
    public function getNameWithQuantityAttribute() {
        return $this->currency->name.' [Owned: '.$this->quantity.']';
=======
     * 
     * @return string
     */
    public function getNameWithQuantityAttribute()
    {
        return $this->currency->name . ' [Owned: ' . $this->quantity . ']';
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
