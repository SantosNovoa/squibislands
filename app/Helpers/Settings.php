<?php

namespace App\Helpers;

<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

class Settings {
=======
use DB;

class Settings {

>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | Retrieves site settings as defined in the database.
    |
    */

    /**
     * Gets a site setting.
     *
<<<<<<< HEAD
     * @param string $key
     *
     * @return mixed|null
     */
    public function get($key) {
        $setting = DB::table('site_settings')->where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        } else {
            return null;
        }
    }
}
=======
     * @param  string  $key
     * @return mixed|null
     */
    public function get($key)
    {
        $setting = DB::table('site_settings')->where('key', $key)->first();
        if($setting) return $setting->value;
        else return null;
    }
}
>>>>>>> Cylunny/extension/polls-and-forms
