<?php

namespace App\Models;

<<<<<<< HEAD
use App\Facades\Settings;
use App\Models\Character\Character;
use App\Models\User\User;

class Trade extends Model {
=======
use Config;
use Settings;

use App\Models\Character\Character;

use App\Models\Model;

class Trade extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id', 'recipient_id', 'comments',
        'status', 'is_sender_confirmed', 'is_recipient_confirmed', 'is_sender_trade_confirmed', 'is_recipient_trade_confirmed',
<<<<<<< HEAD
        'is_approved', 'reason', 'data',
=======
        'is_approved', 'reason', 'data'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trades';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who initiated the trade.
     */
<<<<<<< HEAD
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
=======
    public function sender() 
    {
        return $this->belongsTo('App\Models\User\User', 'sender_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user who received the trade.
     */
<<<<<<< HEAD
    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
=======
    public function recipient() 
    {
        return $this->belongsTo('App\Models\User\User', 'recipient_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the staff member who approved the character transfer.
     */
<<<<<<< HEAD
    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**********************************************************************************************

=======
    public function staff() 
    {
        return $this->belongsTo('App\Models\User\User', 'staff_id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        SCOPES

    **********************************************************************************************/

<<<<<<< HEAD
    public function scopeCompleted($query) {
=======
    public function scopeCompleted($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('status', 'Completed')->orWhere('status', 'Rejected');
    }

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Check if the trade is active.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function getIsActiveAttribute() {
        if ($this->status == 'Pending') {
            return true;
        }

        if (Settings::get('open_transfers_queue')) {
            if ($this->status == 'Accepted' && $this->is_approved == 0) {
                return true;
            }
=======
    public function getIsActiveAttribute()
    {
        if($this->status == 'Pending') return true;

        if(Settings::get('open_transfers_queue')) {
            if($this->status == 'Accepted' && $this->is_approved == 0) return true;
>>>>>>> Cylunny/extension/polls-and-forms
        }

        return false;
    }

    /**
     * Check if the trade can be confirmed.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function getIsConfirmableAttribute() {
        if ($this->is_sender_confirmed && $this->is_recipient_confirmed) {
            return true;
        }

=======
    public function getIsConfirmableAttribute()
    {
        if($this->is_sender_confirmed && $this->is_recipient_confirmed) return true;
>>>>>>> Cylunny/extension/polls-and-forms
        return false;
    }

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
     * Gets the URL of the trade.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('trades/'.$this->id);
    }

    /**********************************************************************************************
<<<<<<< HEAD

        OTHER FUNCTIONS

    **********************************************************************************************/

=======
    
        OTHER FUNCTIONS

    **********************************************************************************************/
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Gets all characters involved in the trade.
     *
     * @return \Illuminate\Support\Collection
     */
<<<<<<< HEAD
    public function getCharacterData() {
=======
    public function getCharacterData()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return Character::with('user')->whereIn('id', array_merge($this->getCharacters($this->sender), $this->getCharacters($this->recipient)))->get();
    }

    /**
     * Gets the inventory of the given user for selection.
     *
<<<<<<< HEAD
     * @param User $user
     *
     * @return array
     */
    public function getInventory($user) {
        $type = $this->sender_id == $user->id ? 'sender' : 'recipient';
        $inventory = $this->data && isset($this->data[$type]) && isset($this->data[$type]['user_items']) ? $this->data[$type]['user_items'] : [];

=======
     * @param  \App\Models\User\User $user
     * @return array
     */
    public function getInventory($user)
    {
        $type = $this->sender_id == $user->id ? 'sender' : 'recipient';
        $inventory = $this->data && isset($this->data[$type]) && isset($this->data[$type]['user_items']) ? $this->data[$type]['user_items'] : [];
>>>>>>> Cylunny/extension/polls-and-forms
        return $inventory;
    }

    /**
     * Gets the characters of the given user for selection.
     *
<<<<<<< HEAD
     * @param User $user
     *
     * @return array
     */
    public function getCharacters($user) {
        $type = $this->sender_id == $user->id ? 'sender' : 'recipient';
        $characters = $this->data && isset($this->data[$type]) && isset($this->data[$type]['characters']) ? $this->data[$type]['characters'] : [];
        if ($characters) {
            $characters = array_keys($characters);
        }

=======
     * @param  \App\Models\User\User $user
     * @return array
     */
    public function getCharacters($user)
    {
        $type = $this->sender_id == $user->id ? 'sender' : 'recipient';
        $characters = $this->data && isset($this->data[$type]) && isset($this->data[$type]['characters']) ? $this->data[$type]['characters'] : [];
        if($characters) $characters = array_keys($characters);
>>>>>>> Cylunny/extension/polls-and-forms
        return $characters;
    }

    /**
     * Gets the currencies of the given user for selection.
     *
<<<<<<< HEAD
     * @param User $user
     *
     * @return array
     */
    public function getCurrencies($user) {
        $type = $this->sender_id == $user->id ? 'sender' : 'recipient';

=======
     * @param  \App\Models\User\User $user
     * @return array
     */
    public function getCurrencies($user)
    {
        $type = $this->sender_id == $user->id ? 'sender' : 'recipient';
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->data && isset($this->data[$type]) && isset($this->data[$type]['currencies']) ? $this->data[$type]['currencies'] : [];
    }
}
