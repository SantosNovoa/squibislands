<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\Currency\Currency;
use App\Models\EventTeam;
use App\Models\SitePage;
use App\Models\User\UserCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Event Controller (Event Tools extension)
    |--------------------------------------------------------------------------
    |
    | Displays information about events based on the current settings,
    | as well as allowing users to join a team if enabled/configured.
    |
    */

    /**
     * Shows the event currency tracking page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEventTracking(Request $request) {
        if (!Settings::get('event_global_score') && !Settings::get('event_teams')) {
            abort(404);
        }

        $total = null;
        if (Settings::get('event_global_score')) {
            $total = UserCurrency::where('user_id', Settings::get('admin_user'))->where('currency_id', Settings::get('event_currency'))->first();
        }

        $goal = Settings::get('event_global_goal');

        return view('events.event_tracking', [
            'currency' => Currency::find(Settings::get('event_currency')),
            'total'    => $total,
            'progress' => $total && $goal ? ($total->quantity < $goal ? ($total->quantity / $goal) * 100 : 100) : 0,
            'teams'    => EventTeam::all(),
            'page'     => SitePage::where('key', 'event-tracker')->first(),
        ]);
    }

    /**
     * Joins a team.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postJoinTeam(Request $request, $id) {
        if (!Settings::get('event_teams')) {
            abort(404);
        }

        $team = EventTeam::where('id', $id)->first();
        if (!$team) {
            abort(404);
        }

        if (Auth::user()->settings->team_id != null) {
            flash('You are already part of a team!')->error();

            return redirect()->back();
        }

        if (Auth::user()->settings->update(['team_id' => $team->id])) {
            flash('Team joined successfully!')->success();
        } else {
            flash('Failed to join team!')->error();
        }

        return redirect()->back();
    }
}
