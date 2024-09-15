<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use App\Models\Boss\Boss;
use App\Services\BossService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BossController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Admin / Boss Controller
    |--------------------------------------------------------------------------
    |
    | Handles creation/editing of bosses and their rewards
    |
    */

    /**********************************************************************************************

        BOSSES

    **********************************************************************************************/

    /**
     * Shows the boss index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getBossIndex(Request $request) {
        $query = Boss::query();
        $data = $request->only(['name']);
        if (isset($data['name'])) {
            $query->where('name', 'LIKE', '%'.$data['name'].'%');
        }

        return view('admin.bosses.bosses', [
            'bosses' => $query->paginate(20)->appends($request->query()),
        ]);
    }

    /**
     * Shows the create boss page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateBoss() {
        $attackMethods = collect(config('lorekeeper.boss_settings.methods'))->map(function ($method, $key) {
            return $method['name'].' - '.$method['description'];
        });

        return view('admin.bosses.create_edit_boss', [
            'boss'          => new Boss,
            'attackMethods' => $attackMethods,
        ]);
    }

    /**
     * Shows the edit boss page.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditBoss($id) {
        $boss = Boss::find($id);
        if (!$boss) {
            abort(404);
        }

        $attackMethods = collect(config('lorekeeper.boss_settings.methods'))->mapWithKeys(function ($method, $key) {
            return [$key => $method['name'].' - '.$method['description']];
        });

        return view('admin.bosses.create_edit_boss', [
            'boss'          => $boss,
            'attackMethods' => $attackMethods,
        ]);
    }

    /**
     * Creates or edits an boss.
     *
     * @param App\Services\BossService $service
     * @param int|null                 $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditBoss(Request $request, BossService $service, $id = null) {
        $id ? $request->validate(Boss::$updateRules) : $request->validate(Boss::$createRules);
        $data = $request->only([
            'name', 'description', 'remove_image', 'image', 'stage_images', 'stage_image_health', 'old_stage_images', 'is_active', 'start_at', 'end_at',
            'total_health', 'current_health', 'type', 'can_attack_after_defeat', 'is_rewards_only_for_participants', 'attack_methods', 'attack_methods_info',
            'rewardable_type', 'rewardable_id', 'quantity', 'threshold', 'is_staff_only', 'allow_users_to_claim_rewards', 'is_reversed',
        ]);
        if ($id && $service->updateBoss(Boss::find($id), $data, Auth::user())) {
            flash('Boss updated successfully.')->success();
        } elseif (!$id && $boss = $service->createBoss($data, Auth::user())) {
            flash('Boss created successfully.')->success();

            return redirect()->to('admin/data/bosses/edit/'.$boss->id);
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Gets the boss deletion modal.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteBoss($id) {
        $boss = Boss::find($id);

        return view('admin.bosses._delete_boss', [
            'boss' => $boss,
        ]);
    }

    /**
     * Creates or edits an boss.
     *
     * @param App\Services\BossService $service
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteBoss(Request $request, BossService $service, $id) {
        if ($id && $service->deleteBoss(Boss::find($id), Auth::user())) {
            flash('Boss deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->to('admin/data/bosses');
    }
}
