<?php

namespace App\Models\Expedition;

use App\Models\Model;

class ExpeditionReward extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expedition_id', 'rewardable_type', 'rewardable_id', 'quantity',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expedition_rewards';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the expedition this reward belongs to.
     */
    public function expedition()
    {
        return $this->belongsTo('App\Models\Expedition\Expedition', 'expedition_id');
    }

    /**
     * Get the actual reward model (Item, Currency, or LootTable).
     */
    public function rewardable()
    {
        return $this->morphTo();
    }
}