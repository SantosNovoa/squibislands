<?php

namespace App\Http\Controllers;

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
        $bosses = Boss::active(Auth::user() ?? Auth::user())->orderBy('name')->get();

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
        $boss = Boss::active(Auth::user() ?? Auth::user())->where('name', $name)->first();

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
     *
     * @param mixed $id
     * @param mixed $attack_method
     */
    public function handleBossAttack(Request $request, BossAttackManager $service, $id, $attack_method) {
        $boss = Boss::active(Auth::user() ?? null)->find($id);
        if (!$boss) {
            abort(404);
        }

        if ($damage = $service->attackBoss($boss, Auth::user(), $attack_method, $request->all())) {
            flash('You dealt '.$damage.' damage to the boss!')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Handles the user claiming rewards from a boss.
     *
     * @param mixed $id
     */
    public function handleClaimRewards(BossAttackManager $service, $id) {
        $boss = Boss::active(Auth::user() ?? null)->find($id);
        if (!$boss) {
            abort(404);
        }

        if ($service->claimRewards($boss, Auth::user())) {
            flash('You have claimed your rewards!')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }
}
