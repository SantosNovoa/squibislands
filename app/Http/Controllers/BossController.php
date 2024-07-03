<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\Boss\Boss;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BossController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Boss Controller
    |--------------------------------------------------------------------------
    |
    | Handles the interaction of bosses.
    |
    */

    /**
     * Shows the boss index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex() {
        $bosses = Boss::active()->orderBy('name')->get();

        return view('boss.index', [
            'bosses' => $bosses,
        ]);
    }

    /**
     * Shows the boss page.
     * 
     * @param string $name
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBoss($name) {
        $boss = Boss::active()->where('name', $name)->first();

        if (!$boss) {
            flash('Boss not found.')->error();

            return redirect()->to('/boss');
        }

        return view('boss.boss', [
            'boss' => $boss,
        ]);
    }
}