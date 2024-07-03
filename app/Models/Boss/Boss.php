<?php

namespace App\Models\Boss;

use Carbon\Carbon;
use App\Models\User\UserBossAttack;
use Illuminate\Database\Eloquent\Model;

class Boss extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'has_image', 'is_active', 'start_at', 'end_at', 'total_health', 'current_health',
        'type', 'can_attack_after_defeat', 'is_rewards_only_for_participants', 'hash', 'stage_images', 'attack_methods',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bosses';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
        'stage_images' => 'array',
        'attack_methods' => 'array',
    ];

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'name'              => 'required|unique:bosses|between:3,100',
        'description'       => 'nullable',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'name'              => 'required|between:3,100',
        'description'       => 'nullable',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the rewards attached to this prompt.
     */
    public function rewards() {
        return $this->hasMany(BossReward::class, 'boss_id');
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include active bosses.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('is_active', 1)
            ->where(function ($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<', Carbon::now());
            })->where(function ($query) {
                $query->whereNull('end_at')->orWhere('end_at', '>', Carbon::now());
            });
    }

    /**
     * Scope a query to sort bosses in alphabetical order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAlphabetical($query, $reverse = false) {
        return $query->orderBy('name', $reverse ? 'DESC' : 'ASC');
    }

    /**
     * Scope a query to sort bosses by newest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * Scope a query to sort bosses oldest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
        return $query->orderBy('id');
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Formatted display name.
     *
     * @return string
     */
    public function getDisplayNameAttribute() {
        if ($this->isActive()) {
            return '<a href="'.$this->idUrl.'" class="display-boss">'.$this->name.'</a>';
        }
        return '<a href="'.$this->url.'">'.$this->name.'</a>';
    }

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
    public function getImageDirectoryAttribute() {
        return 'images/data/bosses';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
    public function getImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
    public function getStageImageFileName($healthPercent) {
        return $this->hash.$this->id.'-'.$healthPercent.'-image.png';
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
    public function getImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
    public function getImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->imageFileName);
    }

    /**
     * Gets the news post URL.
     *
     * @return string
     */
    public function getUrlAttribute() {
        return url('world/bosses/'.$this->name);
    }

    /**
     * Gets the URL of the individual item's page, by ID.
     *
     * @return string
     */
    public function getIdUrlAttribute() {
        if ($this->isActive()) {
            return url('boss/'.$this->name);
        }

        return url('world/bosses/'.$this->name);
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/bosses/edit/'.$this->id);
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

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Gets all of the different boss stage images.
     */
    public function getStageImages() {
        if (!$this->stage_images) {
            return [];
        }

        $images = [];
        foreach ($this->stage_images as $health => $image_name) {
            $images[$health] = [
                'image' => asset($this->imageDirectory.'/'.$image_name),
                'image_name' => $image_name,
            ];
        }

        return $images;
    }

    /**
     * Returns the information, or lack thereof, for a specific attack method.
     */
    public function getAttackMethodInformation($method) {
        if (!in_array($method, $this->attack_methods['methods'])) {
            return [];
        }

        return isset($this->attack_methods['information'][$method]) ? $this->attack_methods['information'][$method] : [];
    }

    /**
     * Returns if this boss is active or not.
     */
    public function isActive() {
        return $this->is_active && (!$this->start_at || $this->start_at < Carbon::now()) && (!$this->end_at || $this->end_at > Carbon::now());
    }

    /**
     * Gets the logs for a specified user for a specified attack method.
     */
    public function getLogs($user, $method = 'all') {
        if ($method == 'all') {
            return UserBossAttack::where('user_id', $user->id)
                ->where('boss_id', $this->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        return UserBossAttack::where('user_id', $user->id)
            ->where('boss_id', $this->id)
            ->where('attack_method', $method)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * Gets the bosses current image based on current_health and available stages.
     */
    public function getCurrentImage() {
        if (!$this->stage_images) {
            return $this->imageUrl;
        }

        $healthPercent = round(($this->current_health / $this->total_health) * 100);
        $currentImage = null;
        $sortedStages = $this->getStageImages();
        krsort($sortedStages);
        foreach ($sortedStages as $health => $image) {
            if ($healthPercent <= $health) {
                $currentImage = $image['image'];
            } else {
                break;
            }
        }

        return $currentImage ?? $this->imageUrl;
    }

    /**
     * Gets the leaderboard of the top players for this boss.
     */
    public function getLeaderboard($limit = null) {
        if (!$limit) {
            $limit = config('lorekeeper.boss_settings.leaderboard_limit');
        }

        return UserBossAttack::where('boss_id', $this->id)
            ->selectRaw('user_id, SUM(damage) as total_damage')
            ->groupBy('user_id')
            ->orderBy('total_damage', 'DESC')
            ->limit($limit)
            ->get();
    }
}
