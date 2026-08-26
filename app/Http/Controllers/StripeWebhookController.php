<?php

namespace App\Http\Controllers;

use App\Services\PremiumShopService;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Stripe Webhook Controller
    |--------------------------------------------------------------------------
    |
    | Handles incoming Stripe webhook events.
    | The webhook route must be excluded from CSRF verification.
    |
    */

    /**
     * Handle a Stripe webhook.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function handleWebhook(Request $request)
    {
        $payload   = $request->getContent();
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? $request->header('Stripe-Signature');
        $secret    = config('services.stripe.webhook.secret');


        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            \Log::error('Stripe webhook error: ' . $e->getMessage());
            return response('Invalid signature.', 400);
        }

        $service = new PremiumShopService;

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $service->fulfillPurchase($event->data->object->id);
                break;
            case 'payment_intent.payment_failed':
                $service->failPurchase($event->data->object->id);
                break;
        }

        return response('Webhook received.', 200);
    }
}