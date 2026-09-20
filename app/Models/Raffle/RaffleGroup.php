<<<<<<< HEAD
<?php

namespace App\Models\Raffle;

use App\Models\Model;

class RaffleGroup extends Model {
=======
<?php namespace App\Models\Raffle;

use App\Models\Model;
use DB;

class RaffleGroup extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'is_active',
=======
        'name', 'is_active'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'raffle_groups';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
<<<<<<< HEAD
    public $timestamps = false;

    /**********************************************************************************************

=======
    public $timestamps = false; 


    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the raffles in this group.
     */
<<<<<<< HEAD
    public function raffles() {
        return $this->hasMany(Raffle::class, 'group_id')->orderBy('order');
=======
    public function raffles()
    {
        return $this->hasMany('App\Models\Raffle\Raffle', 'group_id')->orderBy('order');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
