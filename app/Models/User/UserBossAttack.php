<?php

namespace App\Models\User;

use App\Models\Model;
use App\Models\Boss\Boss;

class UserBossAttack extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'boss_id', 'user_id', 'attack_method', 'data',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_boss_attacks';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

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
