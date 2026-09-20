<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller {
=======
use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Shows the settings index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getIndex() {
        return view('admin.settings.settings', [
            'settings' => DB::table('site_settings')->orderBy('key')->paginate(20),
=======
    public function getIndex()
    {
        return view('admin.settings.settings', [
            'settings' => DB::table('site_settings')->orderBy('key')->paginate(20)
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Edits a setting.
     *
<<<<<<< HEAD
     * @param string $key
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditSetting(Request $request, $key) {
        if (DB::table('site_settings')->where('key', $key)->update(['value' => $request->get('value')])) {
            flash('Setting updated successfully.')->success();
        } else {
            flash('Invalid setting selected.')->success();
        }

=======
     * @param  \Illuminate\Http\Request       $request
     * @param  string                         $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditSetting(Request $request, $key)
    {
        if(DB::table('site_settings')->where('key', $key)->update(['value' => $request->get('value')])) {
            flash('Setting updated successfully.')->success();
        }
        else {
            flash('Invalid setting selected.')->success();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}
