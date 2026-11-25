<?php

namespace App\Services;

use App\Facades\Notifications;
use App\Models\Shop\UserShop;
use App\Models\Shop\UserShopLog;
use App\Models\Shop\UserShopStock;
use Illuminate\Support\Facades\DB;

class UserShopManager extends Service {
    /*
    |--------------------------------------------------------------------------
    | User Shop Manager (User Shops extension)
    |--------------------------------------------------------------------------
    |
    | Handles purchasing of items from user shops.
    |
    */

    /**
     * Buys an item from a user shop.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|UserShop
     */
    public function buyStock($data, $user) {
        DB::beginTransaction();

        try {
            $quantity = $data['quantity'] ?? null;
            if (!is_numeric($quantity) || (int) $quantity != $quantity || (int) $quantity < 1) {
                throw new \Exception('Invalid quantity selected.');
            }
            $quantity = (int) $quantity;

            // Check that the shop exists, is open, and isn't run by a banned user
            $shop = UserShop::where('id', $data['user_shop_id'] ?? null)->where('is_active', 1)->first();
            if (!$shop || !$shop->user || $shop->user->is_banned) {
                throw new \Exception('Invalid shop selected.');
            }
            if ($shop->user_id == $user->id) {
                throw new \Exception("You can't buy from a shop that you own!");
            }

            // Check that the stock exists, belongs to the shop and is on sale.
            // Lock the row so two buyers can't both purchase the last of a stock.
            $shopStock = UserShopStock::where('id', $data['stock_id'] ?? null)->where('user_shop_id', $shop->id)
                ->where('stock_type', 'Item')->where('is_visible', 1)
                ->lockForUpdate()->with('currency')->with('item')->first();
            if (!$shopStock || !$shopStock->item) {
                throw new \Exception('Invalid item selected.');
            }

            // Check there is enough stock remaining
            if ($shopStock->quantity < $quantity) {
                throw new \Exception('There is insufficient stock to fulfill your request.');
            }

            // Only user-owned currencies that can be transferred between users may be used
            $currency = $shopStock->currency;
            if (!$currency || !$currency->is_user_owned || !$currency->allow_user_to_user) {
                throw new \Exception('This item is not priced in a valid currency.');
            }

            $cost = (int) $shopStock->cost;
            if ($cost < 0) {
                throw new \Exception('This item has an invalid cost.');
            }
            $total_cost = $cost * $quantity;

            if ($total_cost > 0 && !(new CurrencyManager)->debitCurrency($user, null, 'User Shop Purchase', 'Purchased '.e($shopStock->item->name).' from '.$shop->displayName, $currency, $total_cost)) {
                throw new \Exception('Not enough currency to make this purchase.');
            }

            $shopStock->quantity -= $quantity;
            $shopStock->save();

            // Add a purchase log
            $shopLog = UserShopLog::create([
                'user_shop_id' => $shop->id,
                'user_id'      => $user->id,
                'currency_id'  => $currency->id,
                'cost'         => $cost,
                'item_id'      => $shopStock->item_id,
                'quantity'     => $quantity,
            ]);

            // Give the buyer the item, noting who sold it and for how much
            $itemData = 'Purchased from '.$shop->displayName.' by '.$user->displayName.' for '.$total_cost.' '.e($currency->name).'.';
            if (!(new InventoryManager)->creditItem(null, $user, 'Shop Purchase', [
                'data'  => $itemData,
                'notes' => 'Purchased '.format_date($shopLog->created_at),
            ], $shopStock->item, $quantity)) {
                throw new \Exception('Failed to purchase item.');
            }

            // Credit the currency to the shop owner
            if ($total_cost > 0 && !(new CurrencyManager)->creditCurrency(null, $shop->user, 'User Shop Credit', 'Sold '.$quantity.'x '.$shopStock->item->displayName.' in '.$shop->displayName, $currency, $total_cost)) {
                throw new \Exception('Failed to credit currency.');
            }

            // Notify the shop owner
            Notifications::create('USER_SHOP_ITEM_SOLD', $shop->user, [
                'shop_id'           => $shop->id,
                'shop_name'         => e($shop->name),
                'item_name'         => e($shopStock->item->name),
                'currency_name'     => e($currency->name),
                'currency_quantity' => $total_cost,
            ]);

            // Once the stock is gone, remove the row
            if ($shopStock->quantity == 0) {
                $shopStock->delete();
            }

            return $this->commitReturn($shop);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
