<?php

namespace App\Providers;

<<<<<<< HEAD
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
=======
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
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
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
<<<<<<< HEAD
     */
    public function map() {
=======
     *
     * @return void
     */
    public function map()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
<<<<<<< HEAD
     */
    protected function mapWebRoutes() {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
=======
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
<<<<<<< HEAD
     */
    protected function mapApiRoutes() {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';
=======
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
