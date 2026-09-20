<<<<<<< HEAD
<?php

namespace App\Models\Raffle;

use App\Models\Model;

class Raffle extends Model {
=======
<?php namespace App\Models\Raffle;

use App\Models\Model;
use DB;

class Raffle extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'is_active', 'winner_count', 'group_id', 'order', 'ticket_cap',
=======
        'name', 'is_active', 'winner_count', 'group_id', 'order'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raffles';
<<<<<<< HEAD
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rolled_at' => 'datetime',
    ];
=======

    /**
     * Dates on the model to convert to Carbon instances.
     *
     * @var array
     */
    public $dates = ['rolled_at'];
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Accessors to append to the model.
     *
     * @var array
     */
    public $appends = ['name_with_group'];

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
<<<<<<< HEAD
    public $timestamps = false;

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the raffle tickets attached to this raffle.
     */
    public function tickets() {
        return $this->hasMany(RaffleTicket::class);
    }

    /**
     * Get the group that this raffle belongs to.
     */
    public function group() {
        return $this->belongsTo(RaffleGroup::class, 'group_id');
    }

    /**********************************************************************************************

=======
    public $timestamps = false; 

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the raffle tickets attached to this raffle.
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Raffle\RaffleTicket');
    }
    
    /**
     * Get the group that this raffle belongs to.
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Raffle\RaffleGroup', 'group_id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the raffle's name, linked to the raffle page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->displayName();
    }

    /**
     * Get the name of the raffle, including group name if there is one.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getNameWithGroupAttribute() {
        return ($this->group_id ? '['.$this->group->name.'] ' : '').$this->name;
    }

    /**
     * Gets the raffle's asset type for asset management.
     *
     * @return string
     */
    public function getAssetTypeAttribute() {
=======
    public function getNameWithGroupAttribute()
    {
        return ($this->group_id ? '[' . $this->group->name . '] ' : '') . $this->name;
    }

    /**
     * Gets the raffle's asset type for asset management. 
     *
     * @return string
     */
    public function getAssetTypeAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return 'raffle_tickets';
    }

    /**
<<<<<<< HEAD
     * Gets the raffle's url.
     *
     * @return string
     */
    public function getUrlAttribute() {
        return url('raffles/view/'.$this->id);
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/raffles'); // Raffles are edited via a modal so don't have a unique raffle edit page
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'manage_raffles';
    }

    /**********************************************************************************************

=======
     * Gets the raffle's url. 
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return url('raffles/view/'.$this->id);
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Displays the raffle's name, linked to the raffle page.
     *
<<<<<<< HEAD
     * @param mixed $asReward
     *
     * @return string
     */
    public function displayName($asReward = true) {
=======
     * @return string
     */
    public function displayName($asReward = true)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'" class="display-raffle">'.$this->name.($asReward ? ' (Raffle Ticket)' : '').'</a>';
    }
}
