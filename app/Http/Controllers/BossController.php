<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\Boss\Boss;
use App\Models\User\User;
use App\Services\BossAttackManager;
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

    /**
     * Handles the user attacking a boss.
     */
    public function handleBossAttack(BossAttackManager $service, $id, $attack_method) {
        $boss = Boss::active()->find($id);
        if (!$boss) {
            abort(404);
        }

        if ($damage = $service->attackBoss($boss, Auth::user(), $attack_method)) {
            flash('You dealt '.$damage.' damage to the boss!')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }
}