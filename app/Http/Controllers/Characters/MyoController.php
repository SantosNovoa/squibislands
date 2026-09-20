<?php

namespace App\Http\Controllers\Characters;

<<<<<<< HEAD
use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use App\Models\Character\CharacterTransfer;
use App\Models\User\User;
use App\Services\CharacterManager;
use App\Services\DesignUpdateManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MyoController extends Controller {
=======
use Illuminate\Http\Request;

use DB;
use Auth;
use Route;
use Settings;
use App\Models\User\User;
use App\Models\Character\Character;
use App\Models\Currency\Currency;
use App\Models\Currency\CurrencyLog;
use App\Models\User\UserCurrency;
use App\Models\Character\CharacterCurrency;
use App\Models\Character\CharacterTransfer;

use App\Services\CurrencyManager;
use App\Services\CharacterManager;

use App\Http\Controllers\Controller;

class MyoController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | MYO Slot Controller
    |--------------------------------------------------------------------------
    |
    | Handles displaying and acting on an MYO slot.
    |
    */

    /**
     * Create a new controller instance.
<<<<<<< HEAD
     */
    public function __construct() {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $id = Route::current()->parameter('id');
            $check = Character::where('id', $id)->first();
            if (!$check) {
                abort(404);
            }

            if ($check->is_myo_slot) {
                $query = Character::myo(1)->where('id', $id);
                if (!(Auth::check() && Auth::user()->hasPower('manage_characters'))) {
                    $query->where('is_visible', 1);
                }
                $this->character = $query->first();
                if (!$this->character) {
                    abort(404);
                }
                $this->character->updateOwner();

                return $next($request);
            } else {
                return redirect('/character/'.$check->slug);
            }
        });
=======
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(function ($request, $next) {
           $id = Route::current()->parameter('id');
           $check = Character::where('id', $id)->first();
           if(!$check) abort(404);

           if($check->is_myo_slot) {
             $query = Character::myo(1)->where('id', $id);
             if(!(Auth::check() && Auth::user()->hasPower('manage_characters'))) $query->where('is_visible', 1);
             $this->character = $query->first();
             if(!$this->character) abort(404);
             $this->character->updateOwner();
             return $next($request);
           }
           else {
             return redirect('/character/' . $check->slug);
           }
       });
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Shows an MYO slot's masterlist entry.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacter($id) {
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacter($id)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return view('character.myo.character', [
            'character' => $this->character,
        ]);
    }

    /**
     * Shows an MYO slot's profile.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterProfile($id) {
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterProfile($id)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return view('character.profile', [
            'character' => $this->character,
        ]);
    }

    /**
     * Shows an MYO slot's edit profile page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditCharacterProfile($id) {
        if (!Auth::check()) {
            abort(404);
        }

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if (!$isMod && !$isOwner) {
            abort(404);
        }
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditCharacterProfile($id)
    {
        if(!Auth::check()) abort(404);

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if(!$isMod && !$isOwner) abort(404);
>>>>>>> Cylunny/extension/polls-and-forms

        return view('character.edit_profile', [
            'character' => $this->character,
        ]);
    }

    /**
     * Edits an MYO slot's profile.
     *
<<<<<<< HEAD
     * @param App\Services\CharacterManager $service
     * @param int                           $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditCharacterProfile(Request $request, CharacterManager $service, $id) {
        if (!Auth::check()) {
            abort(404);
        }

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if (!$isMod && !$isOwner) {
            abort(404);
        }

        if ($service->updateCharacterProfile($request->only(['text', 'is_gift_art_allowed', 'is_trading', 'alert_user']), $this->character, Auth::user(), !$isOwner)) {
            flash('Profile edited successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  int                            $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditCharacterProfile(Request $request, CharacterManager $service, $id)
    {
        if(!Auth::check()) abort(404);

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if(!$isMod && !$isOwner) abort(404);

        if($service->updateCharacterProfile($request->only(['text', 'is_gift_art_allowed', 'is_trading', 'alert_user']), $this->character, Auth::user(), !$isOwner)) {
            flash('Profile edited successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Shows an MYO slot's ownership logs.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterOwnershipLogs($id) {
        return view('character.ownership_logs', [
            'character' => $this->character,
            'logs'      => $this->character->getOwnershipLogs(0),
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterOwnershipLogs($id)
    {
        return view('character.ownership_logs', [
            'character' => $this->character,
            'logs' => $this->character->getOwnershipLogs(0)
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows an MYO slot's ownership logs.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterLogs($id) {
        return view('character.character_logs', [
            'character' => $this->character,
            'logs'      => $this->character->getCharacterLogs(),
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterLogs($id)
    {
        return view('character.character_logs', [
            'character' => $this->character,
            'logs' => $this->character->getCharacterLogs()
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows an MYO slot's submissions.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterSubmissions($id) {
        return view('character.submission_logs', [
            'character' => $this->character,
            'logs'      => $this->character->getSubmissions(),
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterSubmissions($id)
    {
        return view('character.submission_logs', [
            'character' => $this->character,
            'logs' => $this->character->getSubmissions()
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows an MYO slot's transfer page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTransfer($id) {
        if (!Auth::check()) {
            abort(404);
        }

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if (!$isMod && !$isOwner) {
            abort(404);
        }

        return view('character.transfer', [
            'character'      => $this->character,
            'transfer'       => CharacterTransfer::active()->where('character_id', $this->character->id)->first(),
            'cooldown'       => Settings::get('transfer_cooldown'),
            'transfersQueue' => Settings::get('open_transfers_queue'),
            'userOptions'    => User::visible()->orderBy('name')->pluck('name', 'id')->toArray(),
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTransfer($id)
    {
        if(!Auth::check()) abort(404);

        $isMod = Auth::user()->hasPower('manage_characters');
        $isOwner = ($this->character->user_id == Auth::user()->id);
        if(!$isMod && !$isOwner) abort(404);

        return view('character.transfer', [
            'character' => $this->character,
            'transfer' => CharacterTransfer::active()->where('character_id', $this->character->id)->first(),
            'cooldown' => Settings::get('transfer_cooldown'),
            'transfersQueue' => Settings::get('open_transfers_queue'),
            'userOptions' => User::visible()->orderBy('name')->pluck('name', 'id')->toArray(),
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Opens a transfer request for an MYO slot.
     *
<<<<<<< HEAD
     * @param App\Services\CharacterManager $service
     * @param int                           $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTransfer(Request $request, CharacterManager $service, $id) {
        if (!Auth::check()) {
            abort(404);
        }

        if ($service->createTransfer($request->only(['recipient_id', 'user_reason']), $this->character, Auth::user())) {
            flash('Transfer created successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  int                            $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postTransfer(Request $request, CharacterManager $service, $id)
    {
        if(!Auth::check()) abort(404);

        if($service->createTransfer($request->only(['recipient_id', 'user_reason']), $this->character, Auth::user())) {
            flash('Transfer created successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Cancels a transfer request for an MYO slot.
     *
<<<<<<< HEAD
     * @param App\Services\CharacterManager $service
     * @param int                           $id
     * @param int                           $id2
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCancelTransfer(Request $request, CharacterManager $service, $id, $id2) {
        if (!Auth::check()) {
            abort(404);
        }

        if ($service->cancelTransfer(['transfer_id' => $id2], Auth::user())) {
            flash('Transfer cancelled.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request       $request
     * @param  App\Services\CharacterManager  $service
     * @param  int                            $id
     * @param  int                            $id2
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCancelTransfer(Request $request, CharacterManager $service, $id, $id2)
    {
        if(!Auth::check()) abort(404);

        if($service->cancelTransfer(['transfer_id' => $id2], Auth::user())) {
            flash('Transfer cancelled.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Shows an MYO slot's approval page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterApproval($id) {
        if (!Auth::check() || $this->character->user_id != Auth::user()->id) {
            abort(404);
        }
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterApproval($id)
    {
        if(!Auth::check() || $this->character->user_id != Auth::user()->id) abort(404);
>>>>>>> Cylunny/extension/polls-and-forms

        return view('character.update_form', [
            'character' => $this->character,
            'queueOpen' => Settings::get('is_myos_open'),
<<<<<<< HEAD
            'request'   => $this->character->designUpdate()->active()->first(),
=======
            'request' => $this->character->designUpdate()->active()->first()
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Opens a new design approval request for an MYO slot.
     *
<<<<<<< HEAD
     * @param App\Services\DesignUpdateManager $service
     * @param int                              $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterApproval(DesignUpdateManager $service, $id) {
        if (!Auth::check() || $this->character->user_id != Auth::user()->id) {
            abort(404);
        }

        if ($request = $service->createDesignUpdateRequest($this->character, Auth::user())) {
            flash('Successfully created new MYO slot approval draft.')->success();

            return redirect()->to($request->url);
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  App\Services\CharacterManager  $service
     * @param  int                            $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterApproval(CharacterManager $service, $id)
    {
        if(!Auth::check() || $this->character->user_id != Auth::user()->id) abort(404);

        if($request = $service->createDesignUpdateRequest($this->character, Auth::user())) {
            flash('Successfully created new MYO slot approval draft.')->success();
            return redirect()->to($request->url);
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}
