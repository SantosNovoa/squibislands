<?php

namespace App\Http\Middleware;

<<<<<<< HEAD
use App\Facades\Settings;
use Closure;

class CheckAlias {
=======
use Closure;

class CheckAlias
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Redirects users without an alias to the dA account linking page,
     * and banned users to the ban page.
     *
<<<<<<< HEAD
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Settings::get('is_maintenance_mode') == 1 && !$request->user()->hasPower('maintenance_access')) {
            return redirect('/');
        }
        if (!$request->user()->hasAlias) {
            return redirect('/link');
        }
        if (!$request->user()->birthday) {
            return redirect('/birthday');
        }
        if (!$request->user()->checkBirthday) {
            return redirect('/blocked');
        }
        if ($request->user()->is_banned) {
            return redirect('/banned');
        }
        if ($request->user()->is_deactivated) {
            return redirect('/deactivated');
        }
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->user()->has_alias) {
            return redirect('/link');
        }
        if(!$request->user()->birthday) {
            return redirect('/birthday');
        }
        if(!$request->user()->checkBirthday) {
            return redirect('/blocked');
        }
        if($request->user()->is_banned) {
            return redirect('/banned');
        }
>>>>>>> Cylunny/extension/polls-and-forms

        return $next($request);
    }
}
