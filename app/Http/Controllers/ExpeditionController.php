<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Expedition\Expedition;
use App\Models\Character\Character;
use App\Services\ExpeditionService;
use App\Models\Expedition\ExpeditionLog;

class ExpeditionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Expedition Controller
    |--------------------------------------------------------------------------
    |
    | Handles viewing the Expedition index and individual expeditions.
    |
    */

    /**
     * 
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('expeditions.index', [
            'expeditions' => Expedition::where('is_active', 1)->orderBy('name')->get(),
        ]);
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getExpedition($id)
    {
        $expedition = Expedition::where('id', $id)->where('is_active', 1)->first();
        if (!$expedition) abort(404);

        $userLog = null;
        if (Auth::check()) {
            $userLog = ExpeditionLog::where('expedition_id', $expedition->id)
                ->where('user_id', Auth::user()->id)
                ->where('is_claimed', 0)
                ->first();
        }

        return view('expeditions.expedition', [
            'expedition'  => $expedition,
            'expeditions' => Expedition::where('is_active', 1)->orderBy('name')->get(),
            'userLog'     => $userLog,
        ]);
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getSelectCharacters($id)
    {
        $expedition = Expedition::where('id', $id)->where('is_active', 1)->first();
        if (!$expedition) abort(404);

        $busyCharacterIds = \DB::table('expedition_log_character')
            ->join('expedition_logs', 'expedition_logs.id', '=', 'expedition_log_character.expedition_log_id')
            ->where('expedition_logs.is_claimed', 0)
            ->pluck('expedition_log_character.character_id');

        $characters = Character::where('user_id', Auth::user()->id)
            ->whereNotIn('id', $busyCharacterIds)
            ->orderBy('name')
            ->get();

        return view('expeditions._select_characters', [
            'expedition' => $expedition,
            'characters' => $characters,
        ]);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request        $request
     * @param  App\Services\ExpeditionService  $service
     * @param  int                             $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSendExpedition(Request $request, ExpeditionService $service, $id)
    {
        $expedition = Expedition::find($id);
        if (!$expedition) abort(404);

        if ($log = $service->sendExpedition($expedition, $request->get('character_ids', []), Auth::user())) {
            flash('Characters sent on expedition successfully!')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Shows the user's expedition history.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getMyExpeditions()
    {
        return view('expeditions.my', [
            'logs' => ExpeditionLog::with('expedition', 'characters')
                ->where('user_id', Auth::user()->id)
                ->orderBy('completes_at', 'DESC')
                ->get(),
                'expeditions' => Expedition::where('is_active', 1)->orderBy('name')->get(),
        ]);
    }

    /**
     * Claims a completed expedition log.
     *
     * @param  \Illuminate\Http\Request        $request
     * @param  App\Services\ExpeditionService  $service
     * @param  int                             $log_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postClaimExpedition(Request $request, ExpeditionService $service, $log_id)
    {
        $log = ExpeditionLog::find($log_id);
        if (!$log) abort(404);

        $result = $service->claimExpedition($log, Auth::user());

        if ($result) {
            if ($request->ajax()) {
                $rewardList = [];
                foreach ($result['rewards'] as $category => $entries) {
                    foreach ($entries as $entry) {
                        $rewardList[] = ['name' => $entry['asset']->name, 'quantity' => $entry['quantity']];
                    }
                }
                return response()->json([
                    'success' => true,
                    'expedition_success' => (bool) $result['log']->success,
                    'rewards' => $rewardList,
                ]);
            }
            flash('Expedition claimed successfully!')->success();
        } else {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $service->errors()->getMessages()['error']], 422);
            }
            foreach ($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
}