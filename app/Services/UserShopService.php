<?php

namespace App\Services;

use App\Facades\Settings;
use App\Models\Currency\Currency;
use App\Models\Shop\UserShop;
use App\Models\Shop\UserShopStock;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserShopService extends Service {
    /*
    |--------------------------------------------------------------------------
    | User Shop Service (User Shops extension)
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of user shops and shop stock.
    |
    */

    /**
     * Checks whether a user may manage a shop (its owner, or staff with edit_inventories).
     *
     * @param UserShop|null         $shop
     * @param \App\Models\User\User $user
     *
     * @return bool
     */
    public static function canManage($shop, $user) {
        return $shop && $user && ($shop->user_id == $user->id || $user->hasPower('edit_inventories'));
    }

    /**
     * Creates a new shop.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|UserShop
     */
    public function createShop($data, $user) {
        DB::beginTransaction();

        try {
            // Check the shop limit, if there is one
            if (Settings::get('user_shop_limit') != 0) {
                if (UserShop::where('user_id', $user->id)->count() >= Settings::get('user_shop_limit')) {
                    throw new \Exception('You have already created the maximum number of shops.');
                }
            }

            $data['user_id'] = $user->id;
            $data = $this->populateShopData($data);

            $image = null;
            if (isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
                $image = $data['image'];
                unset($data['image']);
            } else {
                $data['has_image'] = 0;
            }

            $shop = UserShop::create($data);

            if ($image) {
                $this->handleImage($image, $shop->shopImagePath, $shop->shopImageFileName);
            }

            return $this->commitReturn($shop);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates a shop.
     *
     * @param UserShop              $shop
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|UserShop
     */
    public function updateShop($shop, $data, $user) {
        DB::beginTransaction();

        try {
            if (!self::canManage($shop, $user)) {
                throw new \Exception('Invalid shop selected.');
            }
            if (UserShop::where('name', $data['name'])->where('id', '!=', $shop->id)->exists()) {
                throw new \Exception('The name has already been taken.');
            }

            $data = $this->populateShopData($data, $shop);

            $image = null;
            if (isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
                $image = $data['image'];
                unset($data['image']);
            }

            $shop->update($data);

            if ($image) {
                $this->handleImage($image, $shop->shopImagePath, $shop->shopImageFileName);
            }

            return $this->commitReturn($shop);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Processes user input for creating/updating a shop.
     *
     * @param array         $data
     * @param UserShop|null $shop
     *
     * @return array
     */
    private function populateShopData($data, $shop = null) {
        if (isset($data['description']) && $data['description']) {
            $data['parsed_description'] = parse($data['description']);
        } else {
            $data['parsed_description'] = null;
        }
        $data['is_active'] = isset($data['is_active']) && $data['is_active'] ? 1 : 0;

        if (isset($data['remove_image'])) {
            if ($shop && $shop->has_image && $data['remove_image']) {
                $data['has_image'] = 0;
                if (file_exists($shop->shopImagePath.'/'.$shop->shopImageFileName)) {
                    $this->deleteImage($shop->shopImagePath, $shop->shopImageFileName);
                }
            }
            unset($data['remove_image']);
        }

        return $data;
    }

    /**
     * Deletes a shop.
     *
     * @param UserShop              $shop
     * @param \App\Models\User\User $user
     *
     * @return bool
     */
    public function deleteShop($shop, $user) {
        DB::beginTransaction();

        try {
            if (!self::canManage($shop, $user)) {
                throw new \Exception('Invalid shop selected.');
            }
            if ($shop->stock()->where('quantity', '>', 0)->count()) {
                throw new \Exception('This shop currently has items stocked. Please remove them and try again.');
            }
            // Delete the 0-quantity stock rows or the shop cannot be deleted
            $shop->stock()->delete();

            if ($shop->has_image && file_exists($shop->shopImagePath.'/'.$shop->shopImageFileName)) {
                $this->deleteImage($shop->shopImagePath, $shop->shopImageFileName);
            }
            $shop->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Sorts a user's shops.
     *
     * @param string                $data
     * @param \App\Models\User\User $user
     *
     * @return bool
     */
    public function sortShop($data, $user) {
        DB::beginTransaction();

        try {
            // Explode the sort array and reverse it since the order is inverted
            $sort = array_reverse(explode(',', (string) $data));

            foreach ($sort as $key => $s) {
                // Only the user's own shops can be sorted
                UserShop::where('id', $s)->where('user_id', $user->id)->update(['sort' => $key]);
            }

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Quick-edits a shop's stock: visibility, cost, currency, and removing stock back to the owner.
     *
     * @param array                 $data
     * @param UserShop|null         $shop
     * @param \App\Models\User\User $user
     *
     * @return bool
     */
    public function quickstockStock($data, $shop, $user) {
        DB::beginTransaction();

        try {
            if (!self::canManage($shop, $user)) {
                throw new \Exception('Invalid shop selected.');
            }

            if (isset($data['stock_id'])) {
                foreach ($data['stock_id'] as $key => $stockId) {
                    $stock = UserShopStock::where('id', $stockId)->where('user_shop_id', $shop->id)->first();
                    if (!$stock) {
                        throw new \Exception('Invalid stock selected.');
                    }

                    $cost = $data['cost'][$key] ?? null;
                    if ($cost === null || $cost === '') {
                        throw new \Exception('One or more of the items is missing a cost.');
                    }
                    if (!is_numeric($cost) || (int) $cost != $cost) {
                        throw new \Exception('Costs must be whole numbers.');
                    }
                    if ((int) $cost < 0) {
                        throw new \Exception('One or more of the items has a negative cost.');
                    }

                    // Only user-owned currencies that can be transferred between users may be used
                    $currencyId = $data['currency_id'][$key] ?? null;
                    if (!$currencyId) {
                        throw new \Exception('One or more of the items is missing a currency.');
                    }
                    if (!Currency::where('id', $currencyId)->where('is_user_owned', 1)->where('allow_user_to_user', 1)->exists()) {
                        throw new \Exception('The selected currency is invalid.');
                    }

                    $stock->update([
                        'is_visible'  => isset($data['is_visible'][$stockId]) ? 1 : 0,
                        'cost'        => (int) $cost,
                        'currency_id' => $currencyId,
                    ]);

                    // Return stock to the owner if a removal quantity was selected
                    if (isset($data['quantity'][$key]) && $data['quantity'][$key] > 0) {
                        $inventoryManager = new InventoryManager;
                        if (!$inventoryManager->sendShop($shop, $shop->user, $stock, $data['quantity'][$key])) {
                            throw new \Exception(implode(' ', $inventoryManager->errors()->getMessages()['error'] ?? ['Could not transfer item to user.']));
                        }
                    }
                }
                $shop->update([
                    'updated_at' => Carbon::now(),
                ]);
            }

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
