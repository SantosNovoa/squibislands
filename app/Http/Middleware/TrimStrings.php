<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

<<<<<<< HEAD
class TrimStrings extends Middleware {
=======
class TrimStrings extends Middleware
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
