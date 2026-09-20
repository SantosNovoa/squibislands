<?php

namespace App\Http\Controllers\Admin\Characters;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use App\Models\Currency\Currency;
use App\Services\AwardCaseManager;
use App\Services\CurrencyManager;
use App\Services\InventoryManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrantController extends Controller {
    /**
     * Grants or removes currency from a character.
     *
     * @param string                       $slug
     * @param App\Services\CurrencyManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterCurrency($slug, Request $request, CurrencyManager $service) {
        $data = $request->only(['currency_id', 'quantity', 'data']);
        if ($service->grantCharacterCurrencies($data, Character::where('slug', $slug)->first(), Auth::user())) {
            flash('Currency granted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
use Auth;
use Config;
use Illuminate\Http\Request;

use App\Models\Character\Character;
use App\Models\Currency\Currency;
use App\Models\Item\Item;

use App\Services\CurrencyManager;
use App\Services\InventoryManager;

use App\Http\Controllers\Controller;

class GrantController extends Controller
{
    /**
     * Grants or removes currency from a character.
     *
     * @param  string                        $slug
     * @param  \Illuminate\Http\Request      $request
     * @param  App\Services\CurrencyManager  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterCurrency($slug, Request $request, CurrencyManager $service)
    {
        $data = $request->only(['currency_id', 'quantity', 'data']);
        if($service->grantCharacterCurrencies($data, Character::where('slug', $slug)->first(), Auth::user())) {
            flash('Currency granted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Grants items to characters.
     *
<<<<<<< HEAD
     * @param string                        $slug
     * @param App\Services\InventoryManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterItems($slug, Request $request, InventoryManager $service) {
        $data = $request->only(['item_ids', 'quantities', 'data', 'disallow_transfer', 'notes']);
        if ($service->grantCharacterItems($data, Character::where('slug', $slug)->first(), Auth::user())) {
            flash('Items granted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Grants awards to characters.
     *
     * @param string                        $slug
     * @param App\Services\InventoryManager $service
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterAwards($slug, Request $request, AwardCaseManager $service) {
        $data = $request->only(['award_ids', 'quantities', 'data', 'disallow_transfer', 'notes']);
        if ($service->grantCharacterAwards($data, Character::where('slug', $slug)->first(), Auth::user())) {
            flash(ucfirst(__('awards.awards')).' granted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  string                          $slug
     * @param  \Illuminate\Http\Request        $request
     * @param  App\Services\InventoryManager   $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCharacterItems($slug, Request $request, InventoryManager $service)
    {
        $data = $request->only(['item_ids', 'quantities', 'data', 'disallow_transfer', 'notes']);
        if($service->grantCharacterItems($data,  Character::where('slug', $slug)->first(), Auth::user())) {
            flash('Items granted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }
}
