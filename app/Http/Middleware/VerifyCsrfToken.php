<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

<<<<<<< HEAD
class VerifyCsrfToken extends Middleware {
=======
class VerifyCsrfToken extends Middleware
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
<<<<<<< HEAD
        'stripe/webhook'
=======
        //
>>>>>>> Cylunny/extension/polls-and-forms
    ];
}
