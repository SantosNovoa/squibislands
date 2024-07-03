<?php

namespace App\Models\User;

use App\Models\Model;
use App\Models\Boss\Boss;

class UserBossAttacks extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'boss_id', 'user_id', 'data',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_boss_attacks';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user this profile belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the boss this attack is for.
     */
    public function boss() {
        return $this->belongsTo(Boss::class);
    }
}
