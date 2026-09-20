<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
=======
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
<<<<<<< HEAD
        // 'App\Model' => 'App\Policies\ModelPolicy',
=======
        'App\Model' => 'App\Policies\ModelPolicy',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * Register any authentication / authorization services.
<<<<<<< HEAD
     */
    public function boot() {
=======
     *
     * @return void
     */
    public function boot()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $this->registerPolicies();

        //
    }
}
