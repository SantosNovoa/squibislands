<?php

namespace App\Models\Expedition;

use App\Models\Model;

class ExpeditionLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expedition_id', 'user_id', 'started_at', 'completes_at', 'is_processed', 'is_claimed',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expedition_logs';

    /**
     * Dates that should be treated as Carbon instances.
     *
     * @var array
     */
    protected $casts = [
        'started_at' => 'datetime',
        'completes_at' => 'datetime',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the expedition template this log belongs to.
     */
    public function expedition()
    {
        return $this->belongsTo('App\Models\Expedition\Expedition', 'expedition_id');
    }

    /**
     * Get the user who sent characters on this trip.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }

    /**
     * Get the characters sent on this trip, including their per-character success result.
     */
    public function characters()
    {
        return $this->belongsToMany('App\Models\Character\Character', 'expedition_log_character', 'expedition_log_id', 'character_id')
            ->withTimestamps();
    }
}