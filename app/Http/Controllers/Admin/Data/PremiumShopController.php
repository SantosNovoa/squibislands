<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\Shop\PremiumShopProduct;
use App\Models\Shop\PremiumShopPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PremiumShopController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin / Premium Shop Controller
    |--------------------------------------------------------------------------
    |
    | Handles admin management of premium shop products.
    |
    */

    /**
     * Shows the product list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('admin.premium-shop.index', [
            'products' => PremiumShopProduct::orderBy('sort', 'DESC')->get(),
        ]);
    }

    /**
     * Shows the create product form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateProduct()
    {
        return view('admin.premium-shop._create_edit_product', [
            'product'    => new PremiumShopProduct,
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'items'      => Item::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    /**
     * Shows the edit product form.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditProduct($id)
    {
        $product = PremiumShopProduct::find($id);
        if (!$product) abort(404);

        return view('admin.premium-shop._create_edit_product', [
            'product'    => $product,
            'currencies' => Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'items'      => Item::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    /**
     * Creates or updates a product.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null                 $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditProduct(Request $request, $id = null)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'price'            => 'required|numeric|min:0.50',
            'rewardable_type'  => 'required|in:Currency,Item',
            'rewardable_id'    => 'required|integer',
            'quantity'         => 'required|integer|min:1',
            'image'            => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        $product = $id ? PremiumShopProduct::find($id) : new PremiumShopProduct;
        if (!$product) abort(404);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = $product->id ?? time();
            $file->move(public_path('images/data/premium-shop'), $filename . '.' . $file->getClientOriginalExtension());
            $product->image = $filename . '.' . $file->getClientOriginalExtension();
        }

        $product->fill([
            'name'            => $request->name,
            'description'     => $request->description,
            'price'           => (int) ($request->price * 100), // convert dollars to cents
            'rewardable_type' => $request->rewardable_type,
            'rewardable_id'   => $request->rewardable_id,
            'quantity'        => $request->quantity,
            'is_active'       => $request->boolean('is_active'),
            'sort'            => $request->sort ?? 0,
        ]);
        $product->save();

        flash($id ? 'Product updated.' : 'Product created.')->success();

        return redirect()->to('admin/data/premium-shop');
    }

    /**
     * Shows the delete product confirmation.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteProduct($id)
    {
        $product = PremiumShopProduct::find($id);
        if (!$product) abort(404);

        return view('admin.premium-shop._delete_product', ['product' => $product]);
    }

    /**
     * Deletes a product.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteProduct($id)
    {
        $product = PremiumShopProduct::find($id);
        if (!$product) abort(404);

        $product->purchases()->delete();
        $product->delete();

        flash('Product deleted.')->success();

        return redirect()->to('admin/data/premium-shop');
    }

    /**
     * Shows purchase history.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPurchases()
    {
        return view('admin.premium-shop.purchases', [
            'purchases' => PremiumShopPurchase::with(['user', 'product'])->orderBy('created_at', 'DESC')->paginate(30),
        ]);
    }
}
