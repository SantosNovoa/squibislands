<?php

namespace App\Http\Controllers;

use App\Models\Shop\PremiumShopProduct;
use App\Services\PremiumShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumShopController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Premium Shop Controller
    |--------------------------------------------------------------------------
    |
    | Displays the premium shop and handles payment intent creation.
    |
    */

    /**
     * Shows the premium shop.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('premium-shop.index', [
            'products'   => PremiumShopProduct::active()->get(),
            'stripeKey'  => config('services.stripe.key'),
        ]);
    }
    /**
     * Shows a log of purchases by the user.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getHistory()
    {
        return view('premium-shop.history', [
            'purchases' => PremiumShopPurchase::where('user_id', Auth::user()->id)
                            ->with('product')
                            ->orderBy('created_at', 'DESC')
                            ->paginate(20),
        ]);
    }

    /**
     * Creates a Stripe PaymentIntent for a product.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateIntent(Request $request, $id)
    {
        $product = PremiumShopProduct::active()->find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        $service = new PremiumShopService;
        $intent  = $service->createPaymentIntent($product, Auth::user());

        if (!$intent) {
            return response()->json(['error' => $service->errors()->first()], 500);
        }

        return response()->json(['clientSecret' => $intent->client_secret]);
    }

        public function getComplete()
    {
        return view('premium-shop.complete');
    }
}