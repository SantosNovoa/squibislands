<?php

namespace App\Http\Controllers\Admin\Data;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Award\Award;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Loot\LootTable;
use App\Models\Pet\Pet;
use App\Services\LootService;
use Illuminate\Http\Request;

class LootTableController extends Controller {
=======
use Illuminate\Http\Request;

use Auth;

use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;

use App\Services\LootService;

use App\Http\Controllers\Controller;

class LootTableController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Admin / Loot Table Controller
    |--------------------------------------------------------------------------
    |
    | Handles creation/editing of loot tables.
    |
    */

    /**
     * Shows the loot table index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getIndex() {
        return view('admin.loot_tables.loot_tables', [
            'tables' => LootTable::paginate(20),
=======
    public function getIndex()
    {
        return view('admin.loot_tables.loot_tables', [
            'tables' => LootTable::paginate(20)
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows the create loot table page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getCreateLootTable() {
=======
    public function getCreateLootTable()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $rarities = Item::whereNotNull('data')->get()->pluck('rarity')->unique()->toArray();
        sort($rarities);

        return view('admin.loot_tables.create_edit_loot_table', [
<<<<<<< HEAD
            'table'      => new LootTable,
            'items'      => Item::orderBy('name')->pluck('name', 'id'),
            'pets'       => Pet::orderBy('name')->pluck('name', 'id'),
            'categories' => ItemCategory::orderBy('sort', 'DESC')->pluck('name', 'id'),
            'currencies' => Currency::orderBy('name')->pluck('name', 'id'),
            'tables'     => LootTable::orderBy('name')->pluck('name', 'id'),
            'rarities'   => array_filter($rarities),
            'awards'     => Award::orderBy('name')->pluck('name', 'id'),
=======
            'table' => new LootTable,
            'items' => Item::orderBy('name')->pluck('name', 'id'),
            'categories' => ItemCategory::orderBy('sort', 'DESC')->pluck('name', 'id'),
            'currencies' => Currency::orderBy('name')->pluck('name', 'id'),
            'tables' => LootTable::orderBy('name')->pluck('name', 'id'),
            'rarities' => array_filter($rarities),
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows the edit loot table page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditLootTable($id) {
        $table = LootTable::find($id);
        if (!$table) {
            abort(404);
        }
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditLootTable($id)
    {
        $table = LootTable::find($id);
        if(!$table) abort(404);
>>>>>>> Cylunny/extension/polls-and-forms

        $rarities = Item::whereNotNull('data')->get()->pluck('rarity')->unique()->toArray();
        sort($rarities);

        return view('admin.loot_tables.create_edit_loot_table', [
<<<<<<< HEAD
            'table'      => $table,
            'items'      => Item::orderBy('name')->pluck('name', 'id'),
            'pets'       => Pet::orderBy('name')->pluck('name', 'id'),
            'categories' => ItemCategory::orderBy('sort', 'DESC')->pluck('name', 'id'),
            'currencies' => Currency::orderBy('name')->pluck('name', 'id'),
            'tables'     => LootTable::orderBy('name')->pluck('name', 'id'),
            'rarities'   => array_filter($rarities),
            'awards'     => Award::orderBy('name')->pluck('name', 'id'),
=======
            'table' => $table,
            'items' => Item::orderBy('name')->pluck('name', 'id'),
            'categories' => ItemCategory::orderBy('sort', 'DESC')->pluck('name', 'id'),
            'currencies' => Currency::orderBy('name')->pluck('name', 'id'),
            'tables' => LootTable::orderBy('name')->pluck('name', 'id'),
            'rarities' => array_filter($rarities),
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Creates or edits a loot table.
     *
<<<<<<< HEAD
     * @param App\Services\LootService $service
     * @param int|null                 $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditLootTable(Request $request, LootService $service, $id = null) {
        $id ? $request->validate(LootTable::$updateRules) : $request->validate(LootTable::$createRules);
        $data = $request->only([
            'name', 'display_name', 'rewardable_type', 'rewardable_id', 'quantity', 'weight',
            'criteria', 'rarity',
        ]);
        if ($id && $service->updateLootTable(LootTable::find($id), $data)) {
            flash('Loot table updated successfully.')->success();
        } elseif (!$id && $table = $service->createLootTable($data)) {
            flash('Loot table created successfully.')->success();

            return redirect()->to('admin/data/loot-tables/edit/'.$table->id);
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\LootService  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditLootTable(Request $request, LootService $service, $id = null)
    {
        $id ? $request->validate(LootTable::$updateRules) : $request->validate(LootTable::$createRules);
        $data = $request->only([
            'name', 'display_name', 'rewardable_type', 'rewardable_id', 'quantity', 'weight',
            'criteria', 'rarity'
        ]);
        if($id && $service->updateLootTable(LootTable::find($id), $data)) {
            flash('Loot table updated successfully.')->success();
        }
        else if (!$id && $table = $service->createLootTable($data)) {
            flash('Loot table created successfully.')->success();
            return redirect()->to('admin/data/loot-tables/edit/'.$table->id);
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Gets the loot table deletion modal.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteLootTable($id) {
        $table = LootTable::find($id);

=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteLootTable($id)
    {
        $table = LootTable::find($id);
>>>>>>> Cylunny/extension/polls-and-forms
        return view('admin.loot_tables._delete_loot_table', [
            'table' => $table,
        ]);
    }

    /**
     * Deletes an item category.
     *
<<<<<<< HEAD
     * @param App\Services\LootService $service
     * @param int                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteLootTable(Request $request, LootService $service, $id) {
        if ($id && $service->deleteLootTable(LootTable::find($id))) {
            flash('Loot table deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\LootService  $service
     * @param  int                       $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteLootTable(Request $request, LootService $service, $id)
    {
        if($id && $service->deleteLootTable(LootTable::find($id))) {
            flash('Loot table deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->to('admin/data/loot-tables');
    }

    /**
     * Gets the loot table test roll modal.
     *
<<<<<<< HEAD
     * @param App\Services\LootService $service
     * @param int                      $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getRollLootTable(Request $request, LootService $service, $id) {
        $table = LootTable::find($id);
        if (!$table) {
            abort(404);
        }
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\LootService  $service
     * @param  int                       $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getRollLootTable(Request $request, LootService $service, $id)
    {
        $table = LootTable::find($id);
        if(!$table) abort(404);
>>>>>>> Cylunny/extension/polls-and-forms

        // Normally we'd merge the result tables, but since we're going to be looking at
        // the results of each roll individually on this page, we'll keep them separate
        $results = [];
<<<<<<< HEAD
        for ($i = 0; $i < $request->get('quantity'); $i++) {
            $results[] = $table->roll();
        }

        return view('admin.loot_tables._roll_loot_table', [
            'table'    => $table,
            'results'  => $results,
            'quantity' => $request->get('quantity'),
=======
        for ($i = 0; $i < $request->get('quantity'); $i++)
            $results[] = $table->roll();

        return view('admin.loot_tables._roll_loot_table', [
            'table' => $table,
            'results' => $results,
            'quantity' => $request->get('quantity')
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }
}
