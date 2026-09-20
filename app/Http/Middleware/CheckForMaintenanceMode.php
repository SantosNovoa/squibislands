<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

<<<<<<< HEAD
class CheckForMaintenanceMode extends Middleware {
=======
class CheckForMaintenanceMode extends Middleware
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
