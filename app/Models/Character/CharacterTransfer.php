<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Facades\Settings;
use App\Models\Model;
use App\Models\User\User;

class CharacterTransfer extends Model {
=======
use Config;
use Settings;
use App\Models\Model;

class CharacterTransfer extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character_id', 'sender_id', 'user_reason', 'recipient_id',
<<<<<<< HEAD
        'status', 'is_approved', 'reason', 'data',
=======
        'status', 'is_approved', 'reason', 'data'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_transfers';
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

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who initiated the transfer.
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
     * Get the user who received the transfer.
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
     * Get the character to be transferred.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class);
=======
    public function character()
    {
        return $this->belongsTo('App\Models\Character\Character');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include pending trades, as well as trades pending staff approval.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        $query->where('status', 'Pending');

        if (Settings::get('open_transfers_queue')) {
            $query->orWhere(function ($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        $query->where('status', 'Pending');

        if(Settings::get('open_transfers_queue')) {
            $query->orWhere(function($query) {
>>>>>>> Cylunny/extension/polls-and-forms
                $query->where('status', 'Accepted')->where('is_approved', 0);
            });
        }

        return $query;
    }

    /**
     * Scope a query to only include completed trades.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query) {
        $query->where('status', 'Rejected')->orWhere('status', 'Canceled')->orWhere(function ($query) {
            $query->where('status', 'Accepted')->where('is_approved', 1);
        });

        return $query;
    }

    /**
     * Scope a query to sort transfers by oldest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
        return $query->orderBy('id');
    }

    /**
     * Scope a query to sort transfers by newest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
        return $query->orderBy('id', 'DESC');
    }

=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        $query->where('status', 'Rejected')->orWhere('status', 'Canceled')->orWhere(function($query) {
            $query->where('status', 'Accepted')->where('is_approved', 1);
        });;
        return $query;
    }

>>>>>>> Cylunny/extension/polls-and-forms
    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Check if the transfer is active.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function getIsActiveAttribute() {
        if ($this->status == 'Pending') {
            return true;
        }
        if (($this->status == 'Accepted') && $this->is_approved == 0) {
            return true;
        }
=======
    public function getIsActiveAttribute()
    {
        if($this->status == 'Pending') return true;
        if(($this->status == 'Accepted') && $this->is_approved == 0) return true;
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
}
