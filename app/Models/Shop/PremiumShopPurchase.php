<?php

namespace App\Models\Shop;

use App\Models\Model;

class PremiumShopPurchase extends Model
{
    protected $table = 'premium_shop_purchases';

    public $timestamps = true;

    protected $fillable = [
        'user_id', 'product_id', 'stripe_payment_intent_id', 'cost', 'status',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(PremiumShopProduct::class, 'product_id');
    }
}