<?php

namespace App\Http\Middleware;

use Closure;

<<<<<<< HEAD
class CheckPower {
    /**
     * Check if the user has the power to access the current page.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed                    $power
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $power) {
        if (!$request->user()->hasPower($power)) {
            flash('You do not have the permission to access this page.')->error();

=======
class CheckPower
{
    /**
     * Check if the user has the power to access the current page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $power)
    {
        if (!$request->user()->hasPower($power)) {
            flash('You do not have the permission to access this page.')->error();
>>>>>>> Cylunny/extension/polls-and-forms
            return redirect('/');
        }

        return $next($request);
    }
}
