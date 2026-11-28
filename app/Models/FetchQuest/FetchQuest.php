<?php

namespace App\Models\FetchQuest;

use App\Models\Item\Item;
use App\Models\Model;

class FetchQuest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'questgiver_name', 'questgiver_url', 'description', 'parsed_description', 'is_active', 'has_image', 'cooldown', 'fetch_item', 'fetch_quantity', 'fetch_category', 'exceptions', 'currency_id', 'extras',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fetch_quests';

    /**
     * Validation rules for character creation.
     *
     * @var array
     */
    public static $createRules = [
        'name' => 'required|between:3,100',
        'questgiver_url' => ['nullable', 'max:255', 'regex:/^(https?:\/\/|\/)\S*$/i'],
    ];

    /**
     * Validation rules for character updating.
     *
     * @var array
     */
    public static $updateRules = [
        'name' => 'required|between:3,100',
        'questgiver_url' => ['nullable', 'max:255', 'regex:/^(https?:\/\/|\/)\S*$/i'],
    ];

    /**********************************************************************************************

    RELATIONS

     **********************************************************************************************/

    /**
     * Get the user's items.
     */
    public function fetchItem()
    {
        return $this->belongsTo('App\Models\Item\Item', 'fetch_item');
    }

    /**
     * Get the user's items.
     */
    public function fetchCurrency()
    {
        return $this->belongsTo('App\Models\Currency\Currency', 'currency_id');
    }

    public function exceptions()
    {
        return $this->hasMany('App\Models\FetchQuest\FetchException');
    }

    public function rewards()
    {
        return $this->hasMany('App\Models\FetchQuest\FetchReward');
    }

    /**
     * Get the items an admin has chosen for this quest to ask for.
     * When any are set, the hourly roll only picks from these instead of a random item.
     */
    public function wantedItems()
    {
        return $this->hasMany(FetchQuestItem::class, 'fetch_quest_id');
    }

    /**
     * Scope a query to show only visible features.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $withHidden = 0)
    {
        if ($withHidden) {
            return $query;
        }
        return $query->where('is_active', 1);
    }

    /**********************************************************************************************

    ACCESSORS

     **********************************************************************************************/

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
    public function getImageDirectoryAttribute()
    {
        return 'images/data/fetch-quests';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
    public function getImageFileNameAttribute()
    {
        return $this->id . '-image.png';
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
    public function getImagePathAttribute()
    {
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory . '/' . $this->imageFileName);
    }

    /**
     * Get the questgiver's link, if one is set.
     *
     * @return string|null
     */
    public function getQuestgiverLinkAttribute()
    {
        // site paths like /world/npcs/3 go through url(), full links are used as-is
        if (!$this->questgiver_url) return null;
        return str_starts_with($this->questgiver_url, '/') ? url($this->questgiver_url) : $this->questgiver_url;
    }

    /**
     * Get the extras attribute as an associative array.
     */
    public function getExtrasAttribute()
    {
        if (!$this->id) {
            return null;
        }

        return json_decode($this->attributes['extras'], true);
    }

    /**
     * Creates a rewards string from an asset array.
     *
     * @param array $array
     *
     * @return string
     */
    /**
     * Rolls a new wanted item and amount from this quest's chosen items.
     * Avoids repeating the current item when there's more than one to choose from.
     * Does nothing (returns false) if no items have been chosen.
     *
     * @return bool
     */
    public function rollWantedItem()
    {
        $choices = $this->wantedItems()->whereHas('item')->get();
        if (!$choices->count()) {
            return false;
        }

        $pool = $choices->count() > 1 ? $choices->where('item_id', '!=', $this->fetch_item)->values() : $choices;
        if (!$pool->count()) {
            $pool = $choices;
        }
        $choice = $pool[mt_rand(0, $pool->count() - 1)];

        $min = max(1, (int) $choice->min_quantity);
        $max = max($min, (int) $choice->max_quantity);

        $this->fetch_item = $choice->item_id;
        $this->fetch_quantity = mt_rand($min, $max);
        $this->save();

        return true;
    }

    /**
     * Items a random (no wanted items) roll can pick from: released, transferable items
     * in the quest's category if one is set, minus any exceptions.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function randomItemQuery()
    {
        $query = Item::where('allow_transfer', 1)->released();

        foreach ($this->exceptions()->get() as $exception) {
            switch ($exception->exception_type) {
                case 'Item':
                    $query->where('id', '<>', $exception->exception_id);
                    break;
                case 'ItemCategory':
                    $query->where('item_category_id', '<>', $exception->exception_id);
                    break;
            }
        }
        if ($this->fetch_category) {
            $query->where('item_category_id', $this->fetch_category);
        }

        return $query;
    }

    /**
     * Rolls a new random item (asked for one at a time), avoiding the current item when there's a choice.
     * Returns false if no item fits the category/exceptions.
     *
     * @return bool
     */
    public function rollRandomItem()
    {
        $ids = $this->randomItemQuery()->pluck('id');
        if (!$ids->count()) {
            return false;
        }

        $pool = $ids->count() > 1 ? $ids->reject(function ($id) {
            return $id == $this->fetch_item;
        })->values() : $ids;
        if (!$pool->count()) {
            $pool = $ids;
        }

        $this->fetch_item = $pool[mt_rand(0, $pool->count() - 1)];
        $this->fetch_quantity = 1;
        $this->save();

        return true;
    }

    /**
     * Checks whether the current fetch item still fits the quest's category/exceptions (e.g. after an admin edit).
     *
     * @return bool
     */
    public function currentFetchMatchesRandomRules()
    {
        return $this->fetch_item && $this->randomItemQuery()->where('id', $this->fetch_item)->exists();
    }

    /**
     * Checks whether the current fetch item/amount still matches the chosen items (e.g. after an admin edit).
     *
     * @return bool
     */
    public function currentFetchMatchesWantedItems()
    {
        $choice = $this->wantedItems->where('item_id', $this->fetch_item)->first();

        return $choice && $this->fetch_quantity >= $choice->min_quantity && $this->fetch_quantity <= $choice->max_quantity;
    }

    public function fetchRewards()
    {
        if (!$this->rewards()) {
            return null;
        }

        $rewards = [];
        foreach ($this->rewards as $reward) {
            $name = $reward->reward->displayName;
            $rewards[] = $name;
        }
        return implode(', ', array_slice($rewards, 0, count($rewards) - 1)) . (count($rewards) > 2 ? ', and ' : ' and ') . end($rewards);
    }

}
