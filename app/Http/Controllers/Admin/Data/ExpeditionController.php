<?php

namespace App\Http\Controllers\Admin\Data;

use Illuminate\Http\Request;

use Auth;

use App\Models\Expedition\Expedition;
use App\Services\ExpeditionService;
use App\Models\Item\Item;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;

use App\Http\Controllers\Controller;

class ExpeditionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin / Expedition Controller
    |--------------------------------------------------------------------------
    |
    | Handles creation/editing of expeditions.
    |
    */

    /**
     * Shows the expedition index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('admin.expeditions.expeditions', [
            'expeditions' => Expedition::orderBy('name')->get()
        ]);
    }

    /**
     * Shows the create expedition page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateExpedition()
    {
        return view('admin.expeditions.create_edit_expedition', [
            'expedition' => new Expedition,
            'items'      => Item::orderBy('name')->pluck('name', 'id'),
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables'     => LootTable::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    /**
     * Shows the edit expedition page.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditExpedition($id)
    {
        $expedition = Expedition::find($id);
        if (!$expedition) abort(404);

        return view('admin.expeditions.create_edit_expedition', [
            'expedition' => $expedition,
            'items'      => Item::orderBy('name')->pluck('name', 'id'),
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables'     => LootTable::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    /**
     * Creates or edits an expedition.
     *
     * @param  \Illuminate\Http\Request     $request
     * @param  App\Services\ExpeditionService  $service
     * @param  int|null                     $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditExpedition(Request $request, ExpeditionService $service, $id = null)
    {
        $id ? $request->validate(Expedition::$updateRules) : $request->validate(Expedition::$createRules);
        $data = $request->only([
            'name', 'difficulty', 'duration_hours', 'success_rate', 'max_characters', 'description',
            'is_active', 'image', 'remove_image',
            'rewardable_type', 'rewardable_id', 'quantity',
        ]);
        if ($id && $service->updateExpedition(Expedition::find($id), $data)) {
            flash('The expedition was updated successfully.')->success();
        } else if (!$id && $expedition = $service->createExpedition($data)) {
            flash('The expedition was created successfully.')->success();
            return redirect()->to('admin/data/expeditions/edit/' . $expedition->id);
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    /**
     * Gets the expedition deletion modal.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteExpedition($id)
    {
        $expedition = Expedition::find($id);
        return view('admin.expeditions._delete_expedition', [
            'expedition' => $expedition,
        ]);
    }

    /**
     * Deletes an expedition.
     *
     * @param  \Illuminate\Http\Request        $request
     * @param  App\Services\ExpeditionService  $service
     * @param  int                             $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteExpedition(Request $request, ExpeditionService $service, $id)
    {
        if ($id && $service->deleteExpedition(Expedition::find($id))) {
            flash('The expedition was deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->to('admin/data/expeditions');
    }
}