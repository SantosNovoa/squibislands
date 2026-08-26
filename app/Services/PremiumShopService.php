<?php

namespace App\Services;

use App\Models\Shop\PremiumShopProduct;
use App\Models\Shop\PremiumShopPurchase;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PremiumShopService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Premium Shop Service
    |--------------------------------------------------------------------------
    |
    | Handles creation of Stripe payment intents and fulfillment of purchases.
    |
    */

    /**
     * Creates a Stripe PaymentIntent for a product.
     *
     * @param PremiumShopProduct $product
     * @param User               $user
     *
     * @return \Stripe\PaymentIntent|false
     */
    public function createPaymentIntent(PremiumShopProduct $product, User $user)
    {
        DB::beginTransaction();

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $intent = PaymentIntent::create([
                'amount'              => $product->price,
                'currency'            => 'usd',
                'receipt_email'       => $user->email,
                'description'         => $product->name . ' x' . $product->quantity,
                'metadata'            => [
                    'user_id'         => $user->id,
                    'product_id'      => $product->id,
                    'product_name'    => $product->name,
                    'quantity'        => $product->quantity,
                ],
            ]);
            // Create a pending purchase record
            PremiumShopPurchase::create([
                'user_id'                  => $user->id,
                'product_id'               => $product->id,
                'stripe_payment_intent_id' => $intent->id,
                'status'                   => 'pending',
            ]);

            DB::commit();

            return $intent;
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        DB::rollback();

        return false;
    }

    /**
     * Fulfills a purchase after successful Stripe payment.
     *
     * @param string $paymentIntentId
     *
     * @return bool
     */
    public function fulfillPurchase($paymentIntentId)
    {
        DB::beginTransaction();

        try {
            $purchase = PremiumShopPurchase::where('stripe_payment_intent_id', $paymentIntentId)
                ->where('status', 'pending')
                ->first();

            if (!$purchase) {
                throw new \Exception('Purchase not found or already fulfilled.');
            }

            $product = $purchase->product;
            $user    = $purchase->user;

            // Build assets array using Lorekeeper's asset helpers
            $rewards = createAssetsArray();

            if ($product->rewardable_type === 'Currency') {
                $currency = \App\Models\Currency\Currency::find($product->rewardable_id);
                if (!$currency) throw new \Exception('Currency not found.');
                addAsset($rewards, $currency, $product->quantity);
            } elseif ($product->rewardable_type === 'Item') {
                $item = \App\Models\Item\Item::find($product->rewardable_id);
                if (!$item) throw new \Exception('Item not found.');
                addAsset($rewards, $item, $product->quantity);
            } else {
                throw new \Exception('Unknown rewardable type.');
            }

            // Grant rewards to user
            if (!fillUserAssets($rewards, null, $user, 'Premium Shop Purchase', [
                'data' => 'Purchased ' . $product->name . ' from the Premium Shop.',
            ])) {
                throw new \Exception('Failed to distribute rewards.');
            }

            $purchase->update(['status' => 'completed']);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        DB::rollback();

        return false;
    }

    /**
     * Marks a purchase as failed.
     *
     * @param string $paymentIntentId
     *
     * @return bool
     */
    public function failPurchase($paymentIntentId)
    {
        $purchase = PremiumShopPurchase::where('stripe_payment_intent_id', $paymentIntentId)->first();
        if ($purchase) {
            $purchase->update(['status' => 'failed']);
        }

        return true;
    }
}