<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class NotificationsProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register() {
=======
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class NotificationsProvider extends ServiceProvider
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
        App::bind('notifications', function () {
=======
     *
     * @return void
     */
    public function boot()
    {
        //
        App::bind('notifications', function()
        {
>>>>>>> Cylunny/extension/polls-and-forms
            return new \App\Helpers\Notifications;
        });
    }
}
