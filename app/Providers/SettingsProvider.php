<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register() {
=======
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class SettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        //
    }

    /**
     * Bootstrap services.
<<<<<<< HEAD
     */
    public function boot() {
        //
        App::bind('settings', function () {
=======
     *
     * @return void
     */
    public function boot()
    {
        //
        App::bind('settings', function()
        {
>>>>>>> Cylunny/extension/polls-and-forms
            return new \App\Helpers\Settings;
        });
    }
}
