<?php

namespace App\Models\Shop;

use App\Models\Model;


class PremiumShopProduct extends Model
{
    protected $table = 'premium_shop_products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'rewardable_type',
        'rewardable_id',
        'quantity',
        'is_active',
        'sort',
    ];

    public $timestamps = true;

    /**********************************************************************************************

        RELATIONS

     **********************************************************************************************/

    /**
     * Get the rewardable (Currency or Item).
     */
    public function rewardable()
    {
        return $this->morphTo();
    }

    public function purchases()
    {
        return $this->hasMany(PremiumShopPurchase::class, 'product_id');
    }

    /**********************************************************************************************

        ACCESSORS

     **********************************************************************************************/

    /**
     * Get the price formatted as a dollar string.
     */
    public function getPriceDisplayAttribute()
    {
        return '$' . number_format($this->price / 100, 2);
    }

    /**
     * Get the product image URL.
     */
    public function getImageUrlAttribute()
    {
        return $this->image
            ? url('images/data/premium-shop/' . $this->image)
            : null;
    }

    /**********************************************************************************************

        SCOPES

     **********************************************************************************************/

    public function scopeActive($query)
    {
        return $query->where('is_active', 1)->orderBy('sort', 'DESC');
    }
}
