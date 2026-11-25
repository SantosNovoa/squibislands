<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Currency\Currency;
use App\Models\EventTeam;
use App\Models\SitePage;
use App\Models\User\UserCurrency;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Admin / Event Controller (Event Tools extension)
    |--------------------------------------------------------------------------
    |
    | Handles event currency tracking settings and event teams.
    |
    */

    /**
     * Show the event settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEventSettings() {
        $total = UserCurrency::where('user_id', Settings::get('admin_user'))->where('currency_id', Settings::get('event_currency'))->first();

        return view('admin.events.event_currency', [
            'currency' => Currency::find(Settings::get('event_currency')),
            'total'    => $total,
            'progress' => $this->getProgress($total),
            'page'     => SitePage::where('key', 'event-tracker')->first(),
            'teams'    => EventTeam::all(),
        ]);
    }

    /**
     * Show the clear event currency modal.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getClearEventCurrency() {
        return view('admin.events._clear_event_currency', [
            'currency' => Currency::find(Settings::get('event_currency')),
        ]);
    }

    /**
     * Zeros event currency for all users.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postClearEventCurrency(Request $request, EventService $service) {
        if ($service->clearEventCurrency(Auth::user())) {
            flash('Event currency cleared successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Processes team info updates.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEventTeams(Request $request, EventService $service) {
        $request->validate(EventTeam::$validationRules);
        $data = $request->only(['name', 'image', 'remove_image', 'score']);
        if ($service->updateTeams($data, Auth::user())) {
            flash('Teams updated successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Gets the global goal progress as a percentage.
     *
     * @param UserCurrency|null $total
     *
     * @return float|int
     */
    private function getProgress($total) {
        $goal = Settings::get('event_global_goal');
        if (!$total || !$goal) {
            return 0;
        }

        return $total->quantity < $goal ? ($total->quantity / $goal) * 100 : 100;
    }
}
