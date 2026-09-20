<?php

namespace App\Models\Item;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\Prompt\Prompt;
use App\Models\Shop\Shop;
use App\Models\Shop\ShopStock;
use App\Models\User\User;

class Item extends Model {
=======
use Config;
use DB;
use App\Models\Model;
use App\Models\Item\ItemCategory;

use App\Models\User\User;
use App\Models\Shop\Shop;
use App\Models\Prompt\Prompt;
use App\Models\User\UserItem;

class Item extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_category_id', 'name', 'has_image', 'description', 'parsed_description', 'allow_transfer',
<<<<<<< HEAD
        'data', 'reference_url', 'artist_alias', 'artist_url', 'artist_id', 'is_released', 'hash', 'is_deletable',
=======
        'data', 'reference_url', 'artist_alias', 'artist_url', 'artist_id', 'is_released'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    protected $appends = ['image_url'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
<<<<<<< HEAD
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'tags',
    ];

    /**
=======
>>>>>>> Cylunny/extension/polls-and-forms
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
<<<<<<< HEAD
        'item_category_id'  => 'nullable',
        'name'              => 'required|unique:items|between:3,100',
        'description'       => 'nullable',
        'image'             => 'mimes:png',
        'rarity'            => 'nullable',
        'reference_url'     => 'nullable|between:3,200',
        'uses'              => 'nullable|between:3,250',
        'release'           => 'nullable|between:3,100',
=======
        'item_category_id' => 'nullable',
        'name' => 'required|unique:items|between:3,100',
        'description' => 'nullable',
        'image' => 'mimes:png',
        'rarity' => 'nullable',
        'reference_url' => 'nullable|between:3,200',
        'uses' => 'nullable|between:3,250',
        'release' => 'nullable|between:3,100',
>>>>>>> Cylunny/extension/polls-and-forms
        'currency_quantity' => 'nullable|integer|min:1',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
<<<<<<< HEAD
        'item_category_id'  => 'nullable',
        'name'              => 'required|between:3,100',
        'description'       => 'nullable',
        'image'             => 'mimes:png',
        'reference_url'     => 'nullable|between:3,200',
        'uses'              => 'nullable|between:3,250',
        'release'           => 'nullable|between:3,100',
=======
        'item_category_id' => 'nullable',
        'name' => 'required|between:3,100',
        'description' => 'nullable',
        'image' => 'mimes:png',
        'reference_url' => 'nullable|between:3,200',
        'uses' => 'nullable|between:3,250',
        'release' => 'nullable|between:3,100',
>>>>>>> Cylunny/extension/polls-and-forms
        'currency_quantity' => 'nullable|integer|min:1',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the category the item belongs to.
     */
<<<<<<< HEAD
    public function category() {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
=======
    public function category()
    {
        return $this->belongsTo('App\Models\Item\ItemCategory', 'item_category_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the item's tags.
     */
<<<<<<< HEAD
    public function tags() {
        return $this->hasMany(ItemTag::class, 'item_id');
=======
    public function tags()
    {
        return $this->hasMany('App\Models\Item\ItemTag', 'item_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user that drew the item art.
     */
<<<<<<< HEAD
    public function artist() {
        return $this->belongsTo(User::class, 'artist_id');
    }

    /**
     * Get shop stock for this item.
     */
    public function shopStock() {
        return $this->hasMany(ShopStock::class, 'item_id');
=======
    public function artist()
    {
        return $this->belongsTo('App\Models\User\User', 'artist_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to sort items in alphabetical order.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAlphabetical($query, $reverse = false) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool                                   $reverse
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAlphabetical($query, $reverse = false)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('name', $reverse ? 'DESC' : 'ASC');
    }

    /**
     * Scope a query to sort items in category order.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortCategory($query) {
        if (ItemCategory::all()->count()) {
            return $query->orderBy(ItemCategory::select('sort')->whereColumn('items.item_category_id', 'item_categories.id'), 'DESC');
        }

        return $query;
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortCategory($query)
    {
        $ids = ItemCategory::orderBy('sort', 'DESC')->pluck('id')->toArray();
        return count($ids) ? $query->orderByRaw(DB::raw('FIELD(item_category_id, '.implode(',', $ids).')')) : $query;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to sort items by newest first.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('id', 'DESC');
    }

    /**
     * Scope a query to sort features oldest first.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('id');
    }

    /**
     * Scope a query to show only released or "released" (at least one user-owned stack has ever existed) items.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed|null                            $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReleased($query, $user = null) {
        if ($user && $user->hasPower('edit_data')) {
            return $query;
        }

        return $query->where('is_released', 1);
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReleased($query)
    {
        return $query->whereIn('id', UserItem::pluck('item_id')->toArray())->orWhere('is_released', 1);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'" class="display-item">'.$this->name.'</a>';
    }

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageDirectoryAttribute() {
=======
    public function getImageDirectoryAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return 'images/data/items';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
=======
    public function getImageFileNameAttribute()
    {
        return $this->id . '-image.png';
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImagePathAttribute() {
=======
    public function getImagePathAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->imageFileName);
=======
    public function getImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->imageFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the URL of the model's encyclopedia page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('world/items?name='.$this->name);
    }

    /**
     * Gets the URL of the individual item's page, by ID.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getIdUrlAttribute() {
=======
    public function getIdUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('world/items/'.$this->id);
    }

    /**
     * Gets the currency's asset type for asset management.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAssetTypeAttribute() {
=======
    public function getAssetTypeAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return 'items';
    }

    /**
     * Get the artist of the item's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getItemArtistAttribute() {
        if (!$this->artist_url && !$this->artist_id) {
            return null;
        }

        // Check to see if the artist exists on site
        $artist = checkAlias($this->artist_url, false);
        if (is_object($artist)) {
=======
    public function getItemArtistAttribute()
    {
        if(!$this->artist_url && !$this->artist_id) return null;

        // Check to see if the artist exists on site
        $artist = checkAlias($this->artist_url, false);
        if(is_object($artist)) {
>>>>>>> Cylunny/extension/polls-and-forms
            $this->artist_id = $artist->id;
            $this->artist_url = null;
            $this->save();
        }

<<<<<<< HEAD
        if ($this->artist_id) {
            return $this->artist->displayName;
        } elseif ($this->artist_url) {
=======
        if($this->artist_id)
        {
            return $this->artist->displayName;
        }
        else if ($this->artist_url)
        {
>>>>>>> Cylunny/extension/polls-and-forms
            return prettyProfileLink($this->artist_url);
        }
    }

    /**
     * Get the reference url attribute.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getReferenceAttribute() {
        if (!$this->reference_url) {
            return null;
        }

=======
    public function getReferenceAttribute()
    {
        if (!$this->reference_url) return null;
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->reference_url;
    }

    /**
     * Get the data attribute as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getDataAttribute() {
        if (!$this->id) {
            return null;
        }

=======
    public function getDataAttribute()
    {
        if (!$this->id) return null;
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->attributes['data'], true);
    }

    /**
     * Get the rarity attribute.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getRarityAttribute() {
        if (!isset($this->data) || !isset($this->data['rarity'])) {
            return null;
        }

=======
    public function getRarityAttribute()
    {
        if (!isset($this->data) || !isset($this->data['rarity'])) return null;
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->data['rarity'];
    }

    /**
     * Get the uses attribute.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUsesAttribute() {
        if (!$this->data) {
            return null;
        }

=======
    public function getUsesAttribute()
    {
        if (!$this->data) return null;
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->data['uses'];
    }

    /**
     * Get the source attribute.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSourceAttribute() {
        if (!$this->data) {
            return null;
        }

=======
    public function getSourceAttribute()
    {
        if (!$this->data) return null;
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->data['release'];
    }

    /**
     * Get the resale attribute.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getResellAttribute() {
        if (!$this->data) {
            return null;
        }

=======
    public function getResellAttribute()
    {
        if (!$this->data) return null;
>>>>>>> Cylunny/extension/polls-and-forms
        return collect($this->data['resell']);
    }

    /**
<<<<<<< HEAD
     * Get the shops that stock this item.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getShopsAttribute() {
        if (!config('lorekeeper.extensions.item_entry_expansion.extra_fields') || !$this->shop_stock_count) {
            return null;
        }

        $shops = Shop::whereIn('id', $this->shopStock->pluck('shop_id')->toArray())->orderBy('sort', 'DESC')->get();

        return $shops;
=======
     * Get the shops attribute as an associative array.
     *
     * @return array
     */
    public function getShopsAttribute()
    {
        if (!$this->data) return null;
        $itemShops = $this->data['shops'];
        return Shop::whereIn('id', $itemShops)->get();
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the prompts attribute as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getPromptsAttribute() {
        if (!$this->data) {
            return null;
        }
        $itemPrompts = $this->data['prompts'];

        if (count($itemPrompts)) {
            return Prompt::whereIn('id', $itemPrompts)->get();
        } else {
            return null;
        }
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/items/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
=======
    public function getPromptsAttribute()
    {
        if (!$this->data) return null;
        $itemPrompts = $this->data['prompts'];
        return Prompt::whereIn('id', $itemPrompts)->get();
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Checks if the item has a particular tag.
     *
<<<<<<< HEAD
     * @param mixed $tag
     *
     * @return bool
     */
    public function hasTag($tag) {
=======
     * @return bool
     */
    public function hasTag($tag)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->tags()->where('tag', $tag)->where('is_active', 1)->exists();
    }

    /**
     * Gets a particular tag attached to the item.
     *
<<<<<<< HEAD
     * @param mixed $tag
     *
     * @return ItemTag
     */
    public function tag($tag) {
=======
     * @return \App\Models\Item\ItemTag
     */
    public function tag($tag)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->tags()->where('tag', $tag)->where('is_active', 1)->first();
    }
}
