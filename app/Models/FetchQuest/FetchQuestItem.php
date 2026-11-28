<?php

namespace App\Models\FetchQuest;

use App\Models\Item\Item;
use App\Models\Model;

class FetchQuestItem extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fetch_quest_id', 'item_id', 'min_quantity', 'max_quantity',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fetch_quest_items';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the fetch quest this wanted item belongs to.
     */
    public function fetchQuest() {
        return $this->belongsTo(FetchQuest::class, 'fetch_quest_id');
    }

    /**
     * Get the wanted item.
     */
    public function item() {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
