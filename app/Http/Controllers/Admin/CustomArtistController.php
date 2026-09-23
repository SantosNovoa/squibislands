<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency\Currency;
use App\Models\CustomArtist\CustomArtistAccess;
use App\Models\CustomArtist\CustomArtistProfile;
use App\Models\Rank\RankPower;
use App\Models\User\User;
use App\Services\CustomArtistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomArtistController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Admin / Custom Artist Controller
    |--------------------------------------------------------------------------
    |
    | Artists edit their own Official Customs entry; admins manage per-user access.
    |
    */

    /**********************************************************************************************

        ARTIST ENTRY

    **********************************************************************************************/

    /**
     * Shows the logged-in artist's entry editor.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProfile() {
        $profile = CustomArtistProfile::with('options')->firstOrNew(['user_id' => Auth::user()->id]);

        return view('admin.custom_artists.profile', [
            'profile'    => $profile,
            'types'      => CustomArtistProfile::TYPES,
            'currencies' => ['' => 'USD ($)'] + Currency::orderBy('name')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Saves the logged-in artist's entry.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProfile(Request $request, CustomArtistService $service) {
        $data = $request->only(['is_active', 'open', 'options', 'contact_site', 'contact_url', 'notes']);

        if ($service->updateProfile(Auth::user(), $data)) {
            flash('Your customs entry has been updated.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**********************************************************************************************

        PER-USER ACCESS

    **********************************************************************************************/

    /**
     * Shows the list of individually-granted users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAccess() {
        $staffRankIds = RankPower::pluck('rank_id')->unique();
        $grantedIds = CustomArtistAccess::pluck('user_id');

        return view('admin.custom_artists.access', [
            'accesses' => CustomArtistAccess::with(['user.rank', 'grantedBy'])->orderBy('created_at', 'desc')->get(),
            'users'    => User::whereIn('rank_id', $staffRankIds)->whereNotIn('id', $grantedIds)->orderBy('name')->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Grants an individual user access.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postGrant(Request $request, CustomArtistService $service) {
        if ($service->grantAccess($request->only(['user_id']), Auth::user())) {
            flash('Access granted.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Revokes an individual user's access.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRevoke(CustomArtistService $service, $id) {
        if ($service->revokeAccess(CustomArtistAccess::find($id), Auth::user())) {
            flash('Access revoked.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }
}
