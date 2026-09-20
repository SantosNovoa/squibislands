<?php

namespace App\Models\Item;

<<<<<<< HEAD
use App\Models\Model;
use Illuminate\Support\Facades\Config;

class ItemTag extends Model {
=======
use Config;
use DB;
use App\Models\Model;

class ItemTag extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'item_id', 'tag', 'data', 'is_active',
=======
        'item_id', 'tag', 'data', 'is_active'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_tags';

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the item that this tag is attached to.
     */
<<<<<<< HEAD
    public function item() {
        return $this->belongsTo(Item::class);
    }

    /**********************************************************************************************

=======
    public function item() 
    {
        return $this->belongsTo('App\Models\Item\Item');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to retrieve only active tags.
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
        return $query->where('is_active', 1);
    }

    /**
     * Scope a query to retrieve only a certain tag.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $tag
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, $tag) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string                                 $tag
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, $tag)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('tag', $tag);
    }

    /**********************************************************************************************
<<<<<<< HEAD

        ACCESSORS

    **********************************************************************************************/

=======
    
        ACCESSORS

    **********************************************************************************************/
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Displays the tag name formatted according to its colours as defined in the config file.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayTagAttribute() {
        $tag = config('lorekeeper.item_tags.'.$this->tag);
        if ($tag) {
            return '<span class="badge" style="color: '.$tag['text_color'].';background-color: '.$tag['background_color'].';">'.$tag['name'].'</span>';
        }

=======
    public function getDisplayTagAttribute()
    {
        $tag = Config::get('lorekeeper.item_tags.' . $this->tag);
        if($tag) return '<span class="badge" style="color: '.$tag['text_color'].';background-color: '.$tag['background_color'].';">'.$tag['name'].'</span>';
>>>>>>> Cylunny/extension/polls-and-forms
        return null;
    }

    /**
     * Get the tag's display name.
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function getName() {
        return config('lorekeeper.item_tags.'.$this->tag.'.name');
=======
    public function getName()
    {
        return Config::get('lorekeeper.item_tags.' . $this->tag.'.name');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the URL of the tag's editing page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAdminUrlAttribute() {
=======
    public function getAdminUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('admin/data/items/tag/'.$this->item_id.'/'.$this->tag);
    }

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
     * Get the service associated with this tag.
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function getServiceAttribute() {
        $class = 'App\Services\Item\\'.str_replace(' ', '', ucwords(str_replace('_', ' ', $this->tag))).'Service';

        return new $class;
    }

    /**********************************************************************************************

=======
    public function getServiceAttribute()
    {
        $class = 'App\Services\Item\\'.str_replace(' ', '', ucwords(str_replace('_', ' ', $this->tag))).'Service';
        return (new $class());
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Get the data used for editing the tag.
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function getEditData() {
=======
    public function getEditData()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->service->getEditData();
    }

    /**
     * Get the data associated with the tag.
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function getData() {
=======
    public function getData()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->service->getTagData($this);
    }
}
