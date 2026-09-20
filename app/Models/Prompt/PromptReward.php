<?php

namespace App\Models\Prompt;

<<<<<<< HEAD
use App\Models\Award\Award;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\Loot\Loot;
use App\Models\Loot\LootTable;
use App\Models\Model;
use App\Models\Pet\Pet;
use App\Models\Raffle\Raffle;
use App\Models\Recipe\Recipe;
use App\Models\Stat\Stat;

class PromptReward extends Model {
=======
use Config;
use App\Models\Model;

class PromptReward extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'prompt_id', 'rewardable_type', 'rewardable_id', 'quantity',
=======
        'prompt_id', 'rewardable_type', 'rewardable_id', 'quantity'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prompt_rewards';
<<<<<<< HEAD
=======
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'rewardable_type' => 'required',
<<<<<<< HEAD
        'rewardable_id'   => 'required',
        'quantity'        => 'required|integer|min:1',
    ];

=======
        'rewardable_id' => 'required',
        'quantity' => 'required|integer|min:1',
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'rewardable_type' => 'required',
<<<<<<< HEAD
        'rewardable_id'   => 'required',
        'quantity'        => 'required|integer|min:1',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the reward attached to the prompt reward.
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
            case 'Pet':
                return $this->belongsTo(Pet::class, 'rewardable_id');
                break;
            case 'Raffle':
                return $this->belongsTo(Raffle::class, 'rewardable_id');
                break;
            case 'Award':
                return $this->belongsTo(Award::class, 'rewardable_id');
                break;
            case 'Recipe':
                return $this->belongsTo(Recipe::class, 'rewardable_id');
                break;
            case 'Points':
                return $this->belongsTo(Stat::class, 'rewardable_id');
                break;
            case 'Exp':
                // Laravel requires a relationship instance to be returned (cannot return null), so returning one that doesn't exist here.
                return $this->belongsTo(Loot::class, 'rewardable_id', 'loot_table_id')->whereNull('loot_table_id');
                break;
        }

=======
        'rewardable_id' => 'required',
        'quantity' => 'required|integer|min:1',
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the reward attached to the prompt reward.
     */
    public function reward() 
    {
        switch ($this->rewardable_type)
        {
            case 'Item':
                return $this->belongsTo('App\Models\Item\Item', 'rewardable_id');
                break;
            case 'Currency':
                return $this->belongsTo('App\Models\Currency\Currency', 'rewardable_id');
                break;
            case 'LootTable':
                return $this->belongsTo('App\Models\Loot\LootTable', 'rewardable_id');
                break;
            case 'Raffle':
                return $this->belongsTo('App\Models\Raffle\Raffle', 'rewardable_id');
                break;
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return null;
    }
}
