<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Item\Item;
use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterItem extends Model {
=======
use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterItem extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'data', 'item_id', 'character_id', 'stack_name',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_items';

    /**
=======
        'data', 'item_id', 'character_id', 'stack_name'
    ];

    /**
>>>>>>> Cylunny/extension/polls-and-forms
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

<<<<<<< HEAD
    /**********************************************************************************************

=======
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_items';

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character who owns the stack.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class);
=======
    public function character() 
    {
        return $this->belongsTo('App\Models\Character\Character');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the item associated with this item stack.
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
        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the data attribute as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getDataAttribute() {
        return json_decode($this->attributes['data'], true);
    }

=======
    public function getDataAttribute() 
    {
        return json_decode($this->attributes['data'], true);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Checks if the stack is transferrable.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getIsTransferrableAttribute() {
        if (!isset($this->data['disallow_transfer']) && $this->item->allow_transfer) {
            return true;
        }

=======
    public function getIsTransferrableAttribute()
    {
        if(!isset($this->data['disallow_transfer']) && $this->item->allow_transfer) return true;
>>>>>>> Cylunny/extension/polls-and-forms
        return false;
    }

    /**
     * Gets the available quantity of the stack.
     *
     * @return int
     */
<<<<<<< HEAD
    public function getAvailableQuantityAttribute() {
        return $this->count;
=======
    public function getAvailableQuantityAttribute()
    {
        return ($this->count);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the stack's asset type for asset management.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAssetTypeAttribute() {
=======
    public function getAssetTypeAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return 'character_items';
    }
}
