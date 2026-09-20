<?php

namespace App\Models\Item;

<<<<<<< HEAD
use App\Models\Character\Character;
use App\Models\Model;
use App\Models\User\User;

class ItemLog extends Model {
=======
use Config;
use App\Models\Model;

class ItemLog extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'sender_id', 'recipient_id',
        'log', 'log_type', 'data',
        'item_id', 'quantity', 'stack_id',
        'sender_type', 'recipient_type',
=======
        'sender_id', 'recipient_id', 
        'log', 'log_type', 'data',
        'item_id', 'quantity', 'stack_id',
        'sender_type', 'recipient_type'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items_log';
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
     * Get the user who initiated the logged action.
     */
<<<<<<< HEAD
    public function sender() {
        if ($this->sender_type == 'User') {
            return $this->belongsTo(User::class, 'sender_id');
        }

        return $this->belongsTo(Character::class, 'sender_id');
=======
    public function sender() 
    {
        if($this->sender_type == 'User') return $this->belongsTo('App\Models\User\User', 'sender_id');
        return $this->belongsTo('App\Models\Character\Character', 'sender_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user who received the logged action.
     */
<<<<<<< HEAD
    public function recipient() {
        if ($this->recipient_type == 'User') {
            return $this->belongsTo(User::class, 'recipient_id');
        }

        return $this->belongsTo(Character::class, 'recipient_id');
=======
    public function recipient() 
    {
        if($this->recipient_type == 'User') return $this->belongsTo('App\Models\User\User', 'recipient_id');
        return $this->belongsTo('App\Models\Character\Character', 'recipient_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the item that is the target of the action.
     */
<<<<<<< HEAD
    public function item() {
        return $this->belongsTo(Item::class);
=======
    public function item() 
    {
        return $this->belongsTo('App\Models\Item\Item');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
