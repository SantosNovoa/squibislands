<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\SitePage;
use Illuminate\Support\Facades\DB;

class PageController extends Controller {
=======
use Auth;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SitePage;

class PageController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Page Controller
    |--------------------------------------------------------------------------
    |
    | Displays site pages, editable from the admin panel.
    |
    */

    /**
     * Shows the page with the given key.
     *
<<<<<<< HEAD
     * @param string $key
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPage($key) {
        $page = SitePage::where('key', $key)->where('is_visible', 1)->first();
        if (!$page) {
            abort(404);
        }

        return view('pages.page', ['page' => $page]);
    }
=======
     * @param  string  $key
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPage($key)
    {
        $page = SitePage::where('key', $key)->where('is_visible', 1)->first();
        if(!$page) abort(404);
        return view('pages.page', ['page' => $page]);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Shows the credits page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getCreditsPage() {
        return view('pages.credits', [
            'credits'    => SitePage::where('key', 'credits')->first(),
            'extensions' => DB::table('site_extensions')->get(),
        ]);
    }
=======
    public function getCreditsPage()
    {
        return view('pages.credits', [
            'credits' => SitePage::where('key', 'credits')->first(),
            'extensions' => DB::table('site_extensions')->get()
        ]);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms
}
