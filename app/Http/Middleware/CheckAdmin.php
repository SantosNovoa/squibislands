<?php

namespace App\Http\Middleware;

use Closure;

<<<<<<< HEAD
class CheckAdmin {
    /**
     * Redirect non-admins to the home page.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!$request->user()->isAdmin) {
            flash('You do not have the permission to access this page.')->error();

=======
class CheckAdmin
{
    /**
     * Redirect non-admins to the home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->isAdmin) {
            flash('You do not have the permission to access this page.')->error();
>>>>>>> Cylunny/extension/polls-and-forms
            return redirect('/');
        }

        return $next($request);
    }
}
