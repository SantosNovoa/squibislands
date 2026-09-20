<?php

namespace App\Models\Loot;

<<<<<<< HEAD
use App\Models\Award\Award;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Model;
use App\Models\Pet\Pet;

class Loot extends Model {
=======
use Config;
use App\Models\Model;

class Loot extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loot_table_id', 'rewardable_type', 'rewardable_id',
<<<<<<< HEAD
        'quantity', 'weight', 'data',
=======
        'quantity', 'weight', 'data'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loots';
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
        'weight'          => 'required|integer|min:1',
=======
        'rewardable_id' => 'required',
        'quantity' => 'required|integer|min:1',
        'weight' => 'required|integer|min:1',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

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
        'weight'          => 'required|integer|min:1',
=======
        'rewardable_id' => 'required',
        'quantity' => 'required|integer|min:1',
        'weight' => 'required|integer|min:1',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the reward attached to the loot entry.
     */
<<<<<<< HEAD
    public function reward() {
        switch ($this->rewardable_type) {
            case 'Item':
                return $this->belongsTo(Item::class, 'rewardable_id');
            case 'ItemRarity':
                return $this->belongsTo(Item::class, 'rewardable_id');
            case 'Currency':
                return $this->belongsTo(Currency::class, 'rewardable_id');
            case 'LootTable':
                return $this->belongsTo(LootTable::class, 'rewardable_id');
            case 'Pet':
                return $this->belongsTo(Pet::class, 'rewardable_id');
            case 'ItemCategory':
                return $this->belongsTo(ItemCategory::class, 'rewardable_id');
            case 'ItemCategoryRarity':
                return $this->belongsTo(ItemCategory::class, 'rewardable_id');
            case 'None':
                // Laravel requires a relationship instance to be returned (cannot return null), so returning one that doesn't exist here.
                return $this->belongsTo(self::class, 'rewardable_id', 'loot_table_id')->whereNull('loot_table_id');
            case 'Award':
                return $this->belongsTo(Award::class, 'rewardable_id');
        }

=======
    public function reward()
    {
        switch ($this->rewardable_type)
        {
            case 'Item':
                return $this->belongsTo('App\Models\Item\Item', 'rewardable_id');
            case 'ItemRarity':
                return $this->belongsTo('App\Models\Item\Item', 'rewardable_id');
            case 'Currency':
                return $this->belongsTo('App\Models\Currency\Currency', 'rewardable_id');
            case 'LootTable':
                return $this->belongsTo('App\Models\Loot\LootTable', 'rewardable_id');
            case 'ItemCategory':
                return $this->belongsTo('App\Models\Item\ItemCategory', 'rewardable_id');
            case 'ItemCategoryRarity':
                return $this->belongsTo('App\Models\Item\ItemCategory', 'rewardable_id');
            case 'None':
                // Laravel requires a relationship instance to be returned (cannot return null), so returning one that doesn't exist here.
                return $this->belongsTo('App\Models\Loot\Loot', 'rewardable_id', 'loot_table_id')->whereNull('loot_table_id');
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return null;
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the data attribute as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getDataAttribute() {
        if (!$this->attributes['data']) {
            return null;
        }

=======
    public function getDataAttribute()
    {
        if (!$this->attributes['data']) return null;
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->attributes['data'], true);
    }
}
