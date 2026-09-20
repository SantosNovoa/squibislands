<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use App\Models\Sales\Sales;
use App\Services\SalesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller {
=======
use Illuminate\Http\Request;

use Auth;

use App\Models\Sales\Sales;
use App\Models\Character\Character;

use App\Services\SalesService;

use App\Http\Controllers\Controller;

class SalesController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Shows the Sales index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getIndex() {
        return view('admin.sales.sales', [
            'saleses' => Sales::orderBy('post_at', 'DESC')->paginate(20),
=======
    public function getIndex()
    {
        return view('admin.sales.sales', [
            'saleses' => Sales::orderBy('post_at', 'DESC')->paginate(20)
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows the create Sales page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getCreateSales() {
        return view('admin.sales.create_edit_sales', [
            'sales' => new Sales,
=======
    public function getCreateSales()
    {
        return view('admin.sales.create_edit_sales', [
            'sales' => new Sales
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows the edit Sales page.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditSales($id) {
        $sales = Sales::find($id);
        if (!$sales) {
            abort(404);
        }

        return view('admin.sales.create_edit_sales', [
            'sales' => $sales,
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditSales($id)
    {
        $sales = Sales::find($id);
        if(!$sales) abort(404);
        return view('admin.sales.create_edit_sales', [
            'sales' => $sales
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows character information.
     *
<<<<<<< HEAD
     * @param string $slug
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterInfo($slug) {
        $character = Character::where('slug', $slug)->first();
=======
     * @param  string  $slug
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCharacterInfo($slug)
    {
        $character = Character::visible()->where('slug', $slug)->first();
>>>>>>> Cylunny/extension/polls-and-forms

        return view('home._character', [
            'character' => $character,
        ]);
    }

    /**
     * Creates or edits a Sales page.
     *
<<<<<<< HEAD
     * @param App\Services\SalesService $service
     * @param int|null                  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditSales(Request $request, SalesService $service, $id = null) {
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\SalesService  $service
     * @param  int|null                  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditSales(Request $request, SalesService $service, $id = null)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        $id ? $request->validate(Sales::$updateRules) : $request->validate(Sales::$createRules);
        $data = $request->only([
            'title', 'text', 'post_at', 'is_visible', 'bump', 'is_open', 'comments_open_at',
            // Character information
<<<<<<< HEAD
            'slug', 'sale_type', 'price', 'starting_bid', 'min_increment', 'autobuy', 'end_point', 'minimum', 'description', 'link', 'character_is_open', 'new_entry', 'image_id',
        ]);
        if ($id && $service->updateSales(Sales::find($id), $data, Auth::user())) {
            flash('Sales updated successfully.')->success();
        } elseif (!$id && $sales = $service->createSales($data, Auth::user())) {
            flash('Sales created successfully.')->success();

            return redirect()->to('admin/sales/edit/'.$sales->id);
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

=======
            'slug', 'sale_type', 'price', 'starting_bid', 'min_increment', 'autobuy', 'end_point', 'minimum', 'description', 'link', 'character_is_open', 'new_entry'
        ]);
        if($id && $service->updateSales(Sales::find($id), $data, Auth::user())) {
            flash('Sales updated successfully.')->success();
        }
        else if (!$id && $sales = $service->createSales($data, Auth::user())) {
            flash('Sales created successfully.')->success();
            return redirect()->to('admin/sales/edit/'.$sales->id);
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return redirect()->back();
    }

    /**
     * Gets the Sales deletion modal.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteSales($id) {
        $sales = Sales::find($id);

=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteSales($id)
    {
        $sales = Sales::find($id);
>>>>>>> Cylunny/extension/polls-and-forms
        return view('admin.sales._delete_sales', [
            'sales' => $sales,
        ]);
    }

    /**
     * Deletes a Sales page.
     *
<<<<<<< HEAD
     * @param App\Services\SalesService $service
     * @param int                       $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteSales(Request $request, SalesService $service, $id) {
        if ($id && $service->deleteSales(Sales::find($id))) {
            flash('Sales deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->to('admin/sales');
    }
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Services\SalesService  $service
     * @param  int                       $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteSales(Request $request, SalesService $service, $id)
    {
        if($id && $service->deleteSales(Sales::find($id))) {
            flash('Sales deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->to('admin/sales');
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
