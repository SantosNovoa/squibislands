<?php

namespace App\Models\Rank;

<<<<<<< HEAD
use App\Models\Model;
use App\Model\App\Models\Theme;
use Illuminate\Support\Arr;
use App\Models\Rank\RankThemeColor;

class Rank extends Model
{
=======
use Config;
use App\Models\Model;
use Illuminate\Support\Arr;

class Rank extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name',
        'description',
        'parsed_description',
        'sort',
        'color',
        'icon',
=======
        'name', 'description', 'parsed_description', 'sort', 'color', 'icon'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ranks';
<<<<<<< HEAD
=======
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for ranks.
     *
     * @var array
     */
    public static $rules = [
<<<<<<< HEAD
        'name'        => 'required|between:3,100',
        'description' => 'nullable',
        'color'       => 'nullable|regex:/^#?[0-9a-fA-F]{6}$/i',
        'icon'        => 'nullable',
    ];

    /**********************************************************************************************

        RELATIONS

     **********************************************************************************************/
=======
        'name' => 'required|between:3,100',
        'description' => 'nullable',
        'color' => 'nullable|regex:/^#?[0-9a-fA-F]{6}$/i',
        'icon' => 'nullable'
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Get the powers attached to this rank.
     */
<<<<<<< HEAD
    public function powers()
    {
        return $this->hasMany(RankPower::class);
    }

    /**
     * Get the per-theme color overrides for this rank.
     */
    public function themeColors()
    {
        return $this->hasMany(RankThemeColor::class);
    }

    /**********************************************************************************************

        ACCESSORS

     **********************************************************************************************/


    /**
     * Display the rank with its associated color, respecting the active theme.
     * Resolves priority: theme override -> primary color -> unstyled.
     *
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        $color = $this->getColorForCurrentTheme();

        if ($color) {
            return '<strong style="color: #' . $color . '">' . $this->name . '</strong>';
        }

        return $this->name;
    }

    public function getColorForCurrentTheme(): ?string
    {
        $themeId = auth()->check()
            ? auth()->user()->theme_id
            : optional(\App\Models\Theme::where('is_default', 1)->first())->id;

        if ($themeId) {
            $override = $this->themeColors()->where('theme_id', $themeId)->first();
            if ($override && $override->color) {
                return ltrim($override->color, '#');
            }
        }

        return $this->color ? ltrim($this->color, '#') : null;
    }

=======
    public function powers() 
    {
        return $this->hasMany('App\Models\Rank\RankPower');
    }

    /**********************************************************************************************
    
        ACCESSORS

    **********************************************************************************************/

    /**
     * Display the rank with its associated colour.
     *
     * @return string
     */
    public function getDisplayNameAttribute() 
    {
        if($this->color) return '<strong style="color: #'.$this->color.'">'.$this->name.'</strong>';
        return $this->name;
    }

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Check if the rank is the admin rank.
     *
     * @return bool
     */
    public function getIsAdminAttribute()
    {
<<<<<<< HEAD
        if ($this->id == self::orderBy('sort', 'DESC')->first()->id) {
            return true;
        }

=======
        if($this->id == Rank::orderBy('sort', 'DESC')->first()->id) return true;
>>>>>>> Cylunny/extension/polls-and-forms
        return false;
    }

    /**********************************************************************************************
<<<<<<< HEAD

        OTHER FUNCTIONS

     **********************************************************************************************/
=======
    
        OTHER FUNCTIONS

    **********************************************************************************************/
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Checks if the current rank is high enough to edit a given rank.
     *
<<<<<<< HEAD
     * @param \App\Models\Rank\Rank
     *
=======
     * @param  \App\Models\Rank\Rank $rank
>>>>>>> Cylunny/extension/polls-and-forms
     * @return int
     */
    public function canEditRank($rank)
    {
<<<<<<< HEAD
        if (is_numeric($rank)) {
            $rank = self::find($rank);
        }
        if ($this->hasPower('edit_ranks')) {
            if ($this->isAdmin) {
                if ($rank->id != $this->id) {
                    return 1;
                } // can edit everything
                else {
                    return 2;
                } // limited edit: cannot edit sort order/powers
            } elseif ($this->sort > $rank->sort) {
                return 1;
            }
        }

=======
        if(is_numeric($rank)) $rank = Rank::find($rank);
        if($this->hasPower('edit_ranks')) {
            if($this->isAdmin) {
                if($rank->id != $this->id) return 1; // can edit everything
                else return 2; // limited edit: cannot edit sort order/powers
            }
            else if ($this->sort > $rank->sort) return 1;
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return 0;
    }

    /**
     * Checks if the rank has a given power.
     *
<<<<<<< HEAD
     * @param RankPower $power
     *
=======
     * @param  \App\Models\Rank\RankPower $power
>>>>>>> Cylunny/extension/polls-and-forms
     * @return bool
     */
    public function hasPower($power)
    {
<<<<<<< HEAD
        if ($this->isAdmin) {
            return true;
        }

        return $this->powers()->where('power', $power)->exists();
=======
        if($this->isAdmin) return true;
        return $this->powers()->where('power', $power)->exists(); 
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the powers associated with the rank.
     *
     * @return array
     */
    public function getPowers()
    {
<<<<<<< HEAD
        if ($this->isAdmin) {
            return config('lorekeeper.powers');
        }
        $powers = $this->powers->pluck('power')->toArray();

        return Arr::only(config('lorekeeper.powers'), $powers);
=======
        if($this->isAdmin) return Config::get('lorekeeper.powers');
        $powers = $this->powers->pluck('power')->toArray();
        return Arr::only(Config::get('lorekeeper.powers'), $powers);
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
