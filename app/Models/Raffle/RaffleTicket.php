<<<<<<< HEAD
<?php

namespace App\Models\Raffle;

use App\Models\Model;
use App\Models\User\User;

class RaffleTicket extends Model {
=======
<?php namespace App\Models\Raffle;

use App\Models\Model;
use DB;

class RaffleTicket extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'user_id', 'raffle_id', 'position', 'created_at', 'alias',
=======
        'user_id', 'raffle_id', 'position', 'created_at', 'alias'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raffle_tickets';

    /**
<<<<<<< HEAD
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'user_id.*'      => 'required_without:alias.*',
        'alias.*'        => 'required_without:user_id.*',
        'ticket_count.*' => 'required',
    ];

    /**********************************************************************************************

=======
     * Dates on the model to convert to Carbon instances.
     *
     * @var array
     */
    protected $dates = ['created_at'];


    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the raffle this ticket is for.
     */
<<<<<<< HEAD
    public function raffle() {
        return $this->belongsTo(Raffle::class);
=======
    public function raffle()
    {
        return $this->belongsTo('App\Models\Raffle\Raffle');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user who owns the raffle ticket.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include the winning tickets in order of drawing.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWinners($query) {
=======
    public function user()
    {
        return $this->belongsTo('App\Models\User\User');
    }

    /**********************************************************************************************
    
        SCOPES

    **********************************************************************************************/
    
    /**
     * Scope a query to only include the winning tickets in order of drawing.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWinners($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $query->whereNotNull('position')->orderBy('position');
    }

    /**********************************************************************************************
<<<<<<< HEAD

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Display the ticket holder's name.
=======
    
        OTHER FUNCTIONS

    **********************************************************************************************/
    
    /**
     * Display the ticket holder's name. 
>>>>>>> Cylunny/extension/polls-and-forms
     * If the owner is not a registered user on the site, this displays the ticket holder's dA name.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayHolderNameAttribute() {
        if ($this->user_id) {
            return $this->user->displayName;
        }

        return $this->alias.' (Off-site user)';
=======
    public function getDisplayHolderNameAttribute()
    {
        if ($this->user_id) return $this->user->displayName;
        return '<a href="http://'.$this->alias.'.deviantart.com">'.$this->alias.'@dA</a>';
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
