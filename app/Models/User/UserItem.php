<?php

namespace App\Models\User;

<<<<<<< HEAD
use App\Models\Item\Item;
use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserItem extends Model {
=======
use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserItem extends Model
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
        'data', 'item_id', 'user_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_items';

    /**
=======
        'data', 'item_id', 'user_id'
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
    protected $table = 'user_items';

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who owns the stack.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class);
=======
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
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
        return $this->count - $this->trade_count - $this->update_count - $this->submission_count;
=======
    public function getAvailableQuantityAttribute()
    {
        return ($this->count - $this->trade_count - $this->update_count- $this->submission_count);
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
        return 'user_items';
    }

    /**
<<<<<<< HEAD
     * Returns string stating amount held elsewhere.
     *
     * @param mixed $tradeCount
     * @param mixed $updateCount
     * @param mixed $submissionCount
     *
     * @return string
     */
    public function getOthers($tradeCount = 0, $updateCount = 0, $submissionCount = 0) {
=======
     * Returns string stating amount held elsewhere
     *
     * @return string
     */
    public function getOthers($tradeCount = 0, $updateCount = 0, $submissionCount = 0)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->getHeldString($this->trade_count - $tradeCount, $this->update_count - $updateCount, $this->submission_count - $submissionCount);
    }

    /**
<<<<<<< HEAD
     * Gets the available quantity based on input context (either trade count or update count).
     *
     * @param mixed $count
     *
     * @return int
     */
    public function getAvailableContextQuantity($count) {
        return $this->getAvailableQuantityAttribute() + $count;
    }

    /**
     * Construct string stating held items.
     *
     * @param mixed $tradeCount
     * @param mixed $updateCount
     * @param mixed $submissionCount
     *
     * @return string
     */
    private function getHeldString($tradeCount, $updateCount, $submissionCount) {
        if (!$tradeCount && !$updateCount && !$submissionCount) {
            return null;
        }
        $held = [];
        if ($tradeCount) {
            array_push($held, $tradeCount.' held in Trades');
        }
        if ($updateCount) {
            array_push($held, $updateCount.' held in Design Updates');
        }
        if ($submissionCount) {
            array_push($held, $submissionCount.' held in Submissions');
        }

        return '('.implode(', ', $held).')';
=======
     * Gets the available quantity based on input context (either trade count or update count)
     *
     * @return int
     */
    public function getAvailableContextQuantity($count)
    {
        return ($this->getAvailableQuantityAttribute() + $count);
    }

    /**
     * Construct string stating held items
     * 
     * @return string
     */
    private function getHeldString($tradeCount, $updateCount, $submissionCount)
    {
        if(!$tradeCount && !$updateCount && !$submissionCount) return null;
        $held = [];
        if($tradeCount) array_push($held, $tradeCount.' held in Trades');
        if($updateCount) array_push($held, $updateCount.' held in Design Updates');
        if($submissionCount) array_push($held, $submissionCount.' held in Submissions');
        return ('('.implode(', ',$held).')');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
