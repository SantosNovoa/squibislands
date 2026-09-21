<?php

namespace App\Models\User;

use App\Models\Boss\Boss;
use App\Models\Model;

class UserBossAttack extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'boss_id', 'user_id', 'attack_method', 'damage', 'data',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_boss_attacks';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

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

    /**********************************************************************************************

        Attributes

    **********************************************************************************************/

    /**
     * Returns the displayname of the attack method.
     */
    public function getAttackMethodDisplayNameAttribute() {
        return config('lorekeeper.boss_settings.methods.'.$this->attack_method.'.name');
    }
}
