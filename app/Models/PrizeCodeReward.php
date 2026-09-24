<?php

namespace App\Models;

use App;
use Config;
use App\Models\Model;

class PrizeCodeReward extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prize_code_id',
        'rewardable_type',
        'rewardable_id',
        'quantity'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prize_code_rewards';

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'rewardable_type' => 'required',
        'rewardable_id' => 'required',
        'quantity' => 'required|integer|min:1'
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'rewardable_type' => 'required',
        'rewardable_id' => 'required',
        'quantity' => 'required|integer|min:1'
    ];

    /**********************************************************************************************
    
        RELATIONS
     **********************************************************************************************/

    /**
     * Get the reward attached to the loot entry.
     */
    public function reward()
    {
        switch ($this->rewardable_type) {
            case 'Item':
                return $this->belongsTo('App\Models\Item\Item', 'rewardable_id');
            case 'Currency':
                return $this->belongsTo('App\Models\Currency\Currency', 'rewardable_id');
            case 'LootTable':
                return $this->belongsTo('App\Models\Loot\LootTable', 'rewardable_id');
            case 'Pet':
                return $this->belongsTo('App\Models\Pet\Pet', 'rewardable_id');
            case 'Award':
                return $this->belongsTo('App\Models\Award\Award', 'rewardable_id');
            case 'Gear':
                return $this->belongsTo('App\Models\Claymore\Gear', 'rewardable_id');
            case 'Weapon':
                return $this->belongsTo('App\Models\Claymore\Weapon', 'rewardable_id');
            case 'Recipe':
                return $this->belongsTo('App\Models\Recipe\Recipe', 'rewardable_id');
            case 'None':
                return $this->belongsTo('App\Models\PrizeCodeRewards', 'rewardable_id', 'prize_code_id')->whereNull('prize_code_id');
        }
        return null;
    }
}
