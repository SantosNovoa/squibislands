<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Currency\Currency;
use App\Models\Model;
use App\Models\Rarity;
use App\Models\Species\Species;
use App\Models\Species\Subtype;
use App\Models\User\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterDesignUpdate extends Model {
=======
use Config;
use DB;
use App\Models\Model;
use App\Models\Currency\Currency;
use App\Models\Feature\FeatureCategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterDesignUpdate extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character_id', 'status', 'user_id', 'staff_id',
        'comments', 'staff_comments', 'data', 'extension',
        'use_cropper', 'x0', 'x1', 'y0', 'y1',
        'hash', 'species_id', 'subtype_id', 'rarity_id',
        'has_comments', 'has_image', 'has_addons', 'has_features',
        'submitted_at', 'update_type', 'fullsize_hash', 
<<<<<<< HEAD
        'approval_votes', 'rejection_votes', 'transformation_id','transformation_info','transformation_description', 'theme'
=======
        'approval_votes', 'rejection_votes'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'design_updates';

    /**
<<<<<<< HEAD
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    /**
=======
>>>>>>> Cylunny/extension/polls-and-forms
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**
<<<<<<< HEAD
=======
     * Dates on the model to convert to Carbon instances.
     *
     * @var array
     */
    public $dates = ['submitted_at'];

    /**
>>>>>>> Cylunny/extension/polls-and-forms
     * Validation rules for uploaded images.
     *
     * @var array
     */
    public static $imageRules = [
<<<<<<< HEAD
        'image'          => 'nullable|mimes:jpeg,gif,png',
        'thumbnail'      => 'nullable|mimes:jpeg,gif,png',
        'artist_url.*'   => 'nullable|url',
        'designer_url.*' => 'nullable|url',
=======
        'image' => 'nullable|mimes:jpeg,gif,png',
        'thumbnail' => 'nullable|mimes:jpeg,gif,png',
        'artist_url.*' => 'nullable|url',
        'designer_url.*' => 'nullable|url'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character associated with the design update.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class, 'character_id');
=======
    public function character()
    {
        return $this->belongsTo('App\Models\Character\Character', 'character_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user who created the design update.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
=======
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the staff who processed the design update.
     */
<<<<<<< HEAD
    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
=======
    public function staff()
    {
        return $this->belongsTo('App\Models\User\User', 'staff_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the species of the design update.
     */
<<<<<<< HEAD
    public function species() {
        return $this->belongsTo(Species::class, 'species_id');
=======
    public function species()
    {
        return $this->belongsTo('App\Models\Species\Species', 'species_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the subtype of the design update.
     */
<<<<<<< HEAD
    public function subtype() {
        return $this->belongsTo(Subtype::class, 'subtype_id');
=======
    public function subtype()
    {
        return $this->belongsTo('App\Models\Species\Subtype', 'subtype_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the rarity of the design update.
     */
<<<<<<< HEAD
    public function rarity() {
        return $this->belongsTo(Rarity::class, 'rarity_id');
=======
    public function rarity()
    {
        return $this->belongsTo('App\Models\Rarity', 'rarity_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the features (traits) attached to the design update, ordered by display order.
     */
<<<<<<< HEAD
    public function features() {
        $query = $this
            ->hasMany(CharacterFeature::class, 'character_image_id')->where('character_features.character_type', 'Update')
            ->join('features', 'features.id', '=', 'character_features.feature_id')
            ->leftJoin('feature_categories', 'feature_categories.id', '=', 'features.feature_category_id')
            ->select(['character_features.*', 'features.*', 'character_features.id AS character_feature_id', 'feature_categories.sort']);

        return $query->orderByDesc('sort');
=======
    public function features()
    {
        $ids = FeatureCategory::orderBy('sort', 'DESC')->pluck('id')->toArray();

        $query = $this->hasMany('App\Models\Character\CharacterFeature', 'character_image_id')->where('character_features.character_type', 'Update')->join('features', 'features.id', '=', 'character_features.feature_id')->select(['character_features.*', 'features.*', 'character_features.id AS character_feature_id']);

        return count($ids) ? $query->orderByRaw(DB::raw('FIELD(features.feature_category_id, '.implode(',', $ids).')')) : $query;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the features (traits) attached to the design update with no extra sorting.
     */
<<<<<<< HEAD
    public function rawFeatures() {
        return $this->hasMany(CharacterFeature::class, 'character_image_id')->where('character_features.character_type', 'Update');
=======
    public function rawFeatures()
    {
        return $this->hasMany('App\Models\Character\CharacterFeature', 'character_image_id')->where('character_features.character_type', 'Update');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the designers attached to the design update.
     */
<<<<<<< HEAD
    public function designers() {
        return $this->hasMany(CharacterImageCreator::class, 'character_image_id')->where('type', 'Designer')->where('character_type', 'Update');
=======
    public function designers()
    {
        return $this->hasMany('App\Models\Character\CharacterImageCreator', 'character_image_id')->where('type', 'Designer')->where('character_type', 'Update');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the artists attached to the design update.
     */
<<<<<<< HEAD
    public function artists() {
        return $this->hasMany(CharacterImageCreator::class, 'character_image_id')->where('type', 'Artist')->where('character_type', 'Update');
    }

        /**
     * Get the transformation of the design update.
     */
    public function transformation() {
        return $this->belongsTo('App\Models\Character\CharacterTransformation', 'transformation_id');
=======
    public function artists()
    {
        return $this->hasMany('App\Models\Character\CharacterImageCreator', 'character_image_id')->where('type', 'Artist')->where('character_type', 'Update');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include active (Open or Pending) update requests.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('status', '!=', 'Approved')->where('status', '!=', 'Rejected');
    }

    /**
     * Scope a query to only include MYO slot approval requests.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyos($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMyos($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $query->select('design_updates.*')->where('update_type', 'MYO');
    }

    /**
     * Scope a query to only include character design update requests.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCharacters($query) {
        $query->select('design_updates.*')->where('update_type', 'Character');
    }

    /**
     * Scope a query to sort updates by oldest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
        return $query->orderBy('id');
    }

    /**
     * Scope a query to sort updates by newest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
        return $query->orderBy('id', 'DESC');
    }

=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCharacters($query)
    {
        $query->select('design_updates.*')->where('update_type', 'Character');
    }

>>>>>>> Cylunny/extension/polls-and-forms
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
=======
    public function getDataAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->attributes['data'], true);
    }

    /**
     * Get the items (UserItem IDs) attached to this update request.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getInventoryAttribute() {
=======
    public function getInventoryAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        // This is for showing the addons page
        // just need to retrieve a list of stack IDs to tell which ones to check

        return $this->data && isset($this->data['user']['user_items']) ? $this->data['user']['user_items'] : [];
    }

    /**
     * Get the user-owned currencies attached to this update request.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getUserBankAttribute() {
=======
    public function getUserBankAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->data && isset($this->data['user']['currencies']) ? $this->data['user']['currencies'] : [];
    }

    /**
     * Get the character-owned currencies attached to this update request.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getCharacterBankAttribute() {
=======
    public function getCharacterBankAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->data && isset($this->data['character']['currencies']) ? $this->data['character']['currencies'] : [];
    }

    /**
     * Check if all sections of the form have been touched.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function getIsCompleteAttribute() {
        return $this->has_comments && $this->has_image && $this->has_addons && $this->has_features;
=======
    public function getIsCompleteAttribute()
    {
        return ($this->has_comments && $this->has_image && $this->has_addons && $this->has_features);
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
        return 'images/character-updates/'.floor($this->id / 1000);
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageFileNameAttribute() {
        return $this->id.'_'.$this->hash.'.'.$this->extension;
=======
    public function getImageFileNameAttribute()
    {
        return $this->id . '_'.$this->hash.'.'.$this->extension;
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
        return asset($this->imageDirectory.'/'.$this->imageFileName);
=======
    public function getImageUrlAttribute()
    {
        return asset($this->imageDirectory . '/' . $this->imageFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the file name of the model's thumbnail image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getThumbnailFileNameAttribute() {
        if (config('lorekeeper.settings.masterlist_image_format') != null && config('lorekeeper.settings.masterlist_image_format') != $this->extension) {
            $extension = config('lorekeeper.settings.masterlist_image_format');
        } else {
            $extension = $this->extension;
        }

        return $this->id.'_'.$this->hash.'_th.'.$extension;
=======
    public function getThumbnailFileNameAttribute()
    {
        return $this->id . '_'.$this->hash.'_th.'.$this->extension;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the path to the file directory containing the model's thumbnail image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getThumbnailPathAttribute() {
=======
    public function getThumbnailPathAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->imagePath;
    }

    /**
     * Gets the URL of the model's thumbnail image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getThumbnailUrlAttribute() {
        return asset($this->imageDirectory.'/'.$this->thumbnailFileName);
=======
    public function getThumbnailUrlAttribute()
    {
        return asset($this->imageDirectory . '/' . $this->thumbnailFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the URL of the design update request.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('designs/'.$this->id);
    }

    /**
     * Gets the voting data of the design update request.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getVoteDataAttribute() {
=======
    public function getVoteDataAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return collect(json_decode($this->attributes['vote_data'], true));
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Get the available currencies that the user can attach to this update request.
     *
<<<<<<< HEAD
     * @param string $type
     *
     * @return array
     */
    public function getBank($type) {
        if ($type == 'user') {
            $currencies = $this->userBank;
        } else {
            $currencies = $this->characterBank;
        }
        if (!count($currencies)) {
            return [];
        }
        $ids = array_keys($currencies);
        $result = Currency::whereIn('id', $ids)->get();
        foreach ($result as $i=> $currency) {
            $currency->quantity = $currencies[$currency->id];
        }

=======
     * @param  string  $type
     * @return array
     */
    public function getBank($type)
    {
        if($type == 'user') $currencies = $this->userBank;
        else $currencies = $this->characterBank;
        if(!count($currencies)) return [];
        $ids = array_keys($currencies);
        $result = Currency::whereIn('id', $ids)->get();
        foreach($result as $i=>$currency)
        {
            $currency->quantity = $currencies[$currency->id];
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $result;
    }
}
