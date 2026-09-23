<?php

namespace App\Http\Middleware;

use App\Models\CustomArtist\CustomArtistAccess;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCustomArtist {
    /**
     * Allows the request if the user's rank has the manage_custom_profile power
     * or they were granted access individually.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (!CustomArtistAccess::userCanEdit(Auth::user())) {
            flash('You do not have the permission to access this page.')->error();

            return redirect('/');
        }

        return $next($request);
    }
}
