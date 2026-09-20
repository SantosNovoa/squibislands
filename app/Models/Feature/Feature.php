<?php

namespace App\Models\Feature;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\Rarity;
use App\Models\Species\Species;
use App\Models\Species\Subtype;
use Illuminate\Support\Facades\DB;

class Feature extends Model {
=======
use Config;
use DB;
use App\Models\Model;
use App\Models\Feature\FeatureCategory;
use App\Models\Species\Species;
use App\Models\Rarity;

class Feature extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'feature_category_id', 'species_id', 'subtype_id', 'rarity_id', 'name', 'has_image', 'description', 'parsed_description', 'is_visible', 'hash',
        'parent_id', 'display_mode', 'display_separate',
=======
        'feature_category_id', 'species_id', 'subtype_id', 'rarity_id', 'name', 'has_image', 'description', 'parsed_description'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'features';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'feature_category_id' => 'nullable',
<<<<<<< HEAD
        'species_id'          => 'nullable',
        'subtype_id'          => 'nullable',
        'rarity_id'           => 'required|exists:rarities,id',
        'name'                => 'required|unique:features|between:3,100',
        'description'         => 'nullable',
        'image'               => 'mimes:png',
=======
        'species_id' => 'nullable',
        'subtype_id' => 'nullable',
        'rarity_id' => 'required|exists:rarities,id',
        'name' => 'required|unique:features|between:3,100',
        'description' => 'nullable',
        'image' => 'mimes:png',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'feature_category_id' => 'nullable',
<<<<<<< HEAD
        'species_id'          => 'nullable',
        'subtype_id'          => 'nullable',
        'rarity_id'           => 'required|exists:rarities,id',
        'name'                => 'required|between:3,100',
        'description'         => 'nullable',
        'image'               => 'mimes:png',
=======
        'species_id' => 'nullable',
        'subtype_id' => 'nullable',
        'rarity_id' => 'required|exists:rarities,id',
        'name' => 'required|between:3,100',
        'description' => 'nullable',
        'image' => 'mimes:png',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the rarity of this feature.
     */
<<<<<<< HEAD
    public function rarity() {
        return $this->belongsTo(Rarity::class);
=======
    public function rarity()
    {
        return $this->belongsTo('App\Models\Rarity');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the species the feature belongs to.
     */
<<<<<<< HEAD
    public function species() {
        return $this->belongsTo(Species::class);
=======
    public function species()
    {
        return $this->belongsTo('App\Models\Species\Species');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the subtype the feature belongs to.
     */
<<<<<<< HEAD
    public function subtype() {
        return $this->belongsTo(Subtype::class);
=======
    public function subtype()
    {
        return $this->belongsTo('App\Models\Species\Subtype');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the category the feature belongs to.
     */
<<<<<<< HEAD
    public function category() {
        return $this->belongsTo(FeatureCategory::class, 'feature_category_id');
    }

    /**
     * Get the parent of this feature, if present.
     */
    public function parent() {
        return $this->belongsTo('App\Models\Feature\Feature', 'parent_id');
    }

    /**
     * Get alternate types of this feature.
     */
    public function altTypes() {
        return $this->hasMany('App\Models\Feature\Feature', 'parent_id');
=======
    public function category()
    {
        return $this->belongsTo('App\Models\Feature\FeatureCategory', 'feature_category_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to sort features in alphabetical order.
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
     * Scope a query to sort features in category order.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortCategory($query) {
        if (FeatureCategory::all()->count()) {
            return $query->orderBy(FeatureCategory::select('sort')->whereColumn('features.feature_category_id', 'feature_categories.id'), 'DESC');
        }

        return $query;
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool                                   $reverse
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortCategory($query)
    {
        $ids = FeatureCategory::orderBy('sort', 'DESC')->pluck('id')->toArray();
        return count($ids) ? $query->orderByRaw(DB::raw('FIELD(feature_category_id, '.implode(',', $ids).')')) : $query;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to sort features in species order.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortSpecies($query) {
        $ids = Species::orderBy('sort', 'DESC')->pluck('id')->toArray();

        return count($ids) ? $query->orderBy(DB::raw('FIELD(species_id, '.implode(',', $ids).')')) : $query;
    }

    /**
     * Scope a query to sort features in subtype order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortSubtype($query) {
        $ids = Subtype::orderBy('sort', 'DESC')->pluck('id')->toArray();

        return count($ids) ? $query->orderByRaw(DB::raw('FIELD(subtype_id, '.implode(',', $ids).')')) : $query;
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool                                   $reverse
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortSpecies($query)
    {
        $ids = Species::orderBy('sort', 'DESC')->pluck('id')->toArray();
        return count($ids) ? $query->orderByRaw(DB::raw('FIELD(species_id, '.implode(',', $ids).')')) : $query;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to sort features in rarity order.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortRarity($query, $reverse = false) {
        $ids = Rarity::orderBy('sort', $reverse ? 'ASC' : 'DESC')->pluck('id')->toArray();

        return count($ids) ? $query->orderBy(DB::raw('FIELD(rarity_id, '.implode(',', $ids).')')) : $query;
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool                                   $reverse
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortRarity($query, $reverse = false)
    {
        $ids = Rarity::orderBy('sort', $reverse ? 'ASC' : 'DESC')->pluck('id')->toArray();
        return count($ids) ? $query->orderByRaw(DB::raw('FIELD(rarity_id, '.implode(',', $ids).')')) : $query;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to sort features by newest first.
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
        return $query->orderBy('id');
    }

    /**
     * Scope a query to show only visible features.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed|null                            $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query, $user = null) {
        if ($user && $user->hasPower('edit_data')) {
            return $query;
        }

        return $query->where('is_visible', 1);
    }

=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query)
    {
        return $query->orderBy('id');
    }

>>>>>>> Cylunny/extension/polls-and-forms
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
        if (($this->parent_id || $this->altTypes->count()) && $this->display_mode != 0) {
            switch ($this->display_mode) {
                case 1:
                    $name = $this->name.' ('.($this->species ? $this->species->name : 'None').')';
                case 2:
                    if ($this->subtype) {
                        $name = $this->name.' ('.$this->subtype->name.')';
                    }
                    break;
                case 3:
                    if ($this->parent) {
                        $name = $this->parent->name.' ('.$this->name.')';
                    }
                    break;
                case 4:
                    if ($this->parent) {
                        $name = $this->name.' '.$this->parent->name;
                    }
                    break;
            }
        }

        return '<a href="'.($this->parent_id && !$this->display_separate ? $this->parent->url : $this->url).'" class="display-trait">'.($name ?? $this->name).'</a>'.($this->rarity ? ' ('.$this->rarity->displayName.')' : '');
    }

    /**
     * Displays the model's name, clarified.
     *
     * @return string
     */
    public function getSelectionNameAttribute() {
        if (($this->parent_id || $this->altTypes->count()) && $this->display_mode != 0) {
            switch ($this->display_mode) {
                case 1:
                    $name = $this->name.' ('.($this->species ? $this->species->name : 'None').')';
                    break;
                case 2:
                    if ($this->subtype) {
                        $name = $this->name.' ('.$this->subtype->name.')';
                    }
                    break;
                case 3:
                    if ($this->parent) {
                        $name = $this->parent->name.' ('.$this->name.')';
                    }
                    break;
                case 4:
                    if ($this->parent) {
                        $name = $this->name.' '.$this->parent->name;
                    }
                    break;
            }
        }
        if (!isset($name)) {
            $name = $this->name;
        }

        if ($this->parent_id && $name == $this->parent->name) {
            $diffArray = [];
            if ($this->rarity_id && $this->parent->rarity_id && $this->rarity_id != $this->parent->rarity_id) {
                $diffArray[] = $this->rarity->name;
            }
            if ($this->species_id && $this->parent->species_id && $this->species_id != $this->parent->species_id) {
                $diffArray[] = $this->species->name;
            }
            if ($this->subtype_id && $this->parent->subtype_id && $this->subtype_id != $this->parent->subtype_id) {
                $diffArray[] = $this->subtype->name;
            }

            $name = $this->name.' ('.implode('/', $diffArray).')';
        }

        return $name;
=======
    public function getDisplayNameAttribute()
    {
        return '<a href="'.$this->url.'" class="display-trait">'.$this->name.'</a>'.($this->rarity? ' (' . $this->rarity->displayName . ')' : '');
>>>>>>> Cylunny/extension/polls-and-forms
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
        return 'images/data/traits';
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
        return url('world/traits?name='.$this->name);
    }

    /**
     * Gets the URL for a masterlist search of characters in this category.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSearchUrlAttribute() {
        return url('masterlist?feature_id[]='.$this->id);
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/traits/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
    }

    /**********************************************************************************************

        Other Functions

    **********************************************************************************************/

    public static function getDropdownItems($withHidden = 0) {
        $visibleOnly = 1;
        if ($withHidden) {
            $visibleOnly = 0;
        }

        if (config('lorekeeper.extensions.organised_traits_dropdown')) {
            $sorted_feature_categories = collect(FeatureCategory::all()->where('is_visible', '>=', $visibleOnly)->sortBy('sort')->pluck('name')->toArray());

            $grouped = self::where('is_visible', '>=', $visibleOnly)->select('name', 'id', 'feature_category_id')->with('category')->orderBy('name')->get()->keyBy('id')->groupBy('category.name', $preserveKeys = true)->toArray();
            if (isset($grouped[''])) {
                if (!$sorted_feature_categories->contains('Miscellaneous')) {
                    $sorted_feature_categories->push('Miscellaneous');
                }
                $grouped['Miscellaneous'] ??= [] + $grouped[''];
            }

            $sorted_feature_categories = $sorted_feature_categories->filter(function ($value, $key) use ($grouped) {
                return in_array($value, array_keys($grouped), true);
            });

            foreach ($grouped as $category => $features) {
                foreach ($features as $id  => $feature) {
                    $grouped[$category][$id] = $feature['name'];
                }
            }
            $features_by_category = $sorted_feature_categories->map(function ($category) use ($grouped) {
                return [$category => $grouped[$category]];
            });

            return $features_by_category;
        } else {
            return self::where('is_visible', '>=', $visibleOnly)->orderBy('name')->pluck('name', 'id')->toArray();
        }
    }
=======
    public function getSearchUrlAttribute()
    {
        return url('masterlist?feature_id[]='.$this->id);
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
