<?php

namespace App\Models\Boss;

use Illuminate\Database\Eloquent\Model;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\Loot\LootTable;
use App\Models\Raffle\Raffle;

class BossReward extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'boss_id', 'rewardable_type', 'rewardable_id', 'quantity', 'threshold',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boss_rewards';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'rewardable_type' => 'required',
        'rewardable_id'   => 'required',
        'quantity'        => 'required|integer|min:1',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'rewardable_type' => 'required',
        'rewardable_id'   => 'required',
        'quantity'        => 'required|integer|min:1',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the reward attached to the boss reward.
     */
    public function reward() {
        switch ($this->rewardable_type) {
            case 'Item':
                return $this->belongsTo(Item::class, 'rewardable_id');
                break;
            case 'Currency':
                return $this->belongsTo(Currency::class, 'rewardable_id');
                break;
            case 'LootTable':
                return $this->belongsTo(LootTable::class, 'rewardable_id');
                break;
            case 'Raffle':
                return $this->belongsTo(Raffle::class, 'rewardable_id');
                break;
        }

        return null;
    }
}
