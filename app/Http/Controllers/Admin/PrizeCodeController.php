<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\Models\PrizeCode;
use App\Services\PrizeCodeService;
use App\Models\Item\Item;
use App\Models\Item\ItemCategory;
use App\Models\Loot\LootTable;
use App\Models\Raffle\Raffle;
use App\Models\Currency\Currency;
use App\Models\User\UserPrizeLog;
use App\Models\Pet\Pet;
use App\Models\Award\Award;
use App\Models\Claymore\Gear;
use App\Models\Claymore\Weapon;
use App\Models\Recipe\Recipe;

use App\Http\Controllers\Controller;

class PrizeCodeController extends Controller
{
    public function getIndex()
    {
        return view('admin.prize_codes.prize_codes', [
            'prizes' => PrizeCode::orderBy('id', 'DESC')->paginate(20)
        ]);
    }

    public function getCreatePrize()
    {
        return view('admin.prize_codes.create_edit_prize_code', [
            'prize'     => new PrizeCode,
            'items'     => Item::orderBy('name')->pluck('name', 'id'),
            'categories'=> ItemCategory::orderBy('name')->pluck('name', 'id'),
            'currencies'=> Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables'    => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles'   => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
            'pets'      => Pet::orderBy('name')->pluck('name', 'id'),
            'awards'    => Award::orderBy('name')->pluck('name', 'id'),
            'gear'      => Gear::orderBy('name')->pluck('name', 'id'),
            'weapons'   => Weapon::orderBy('name')->pluck('name', 'id'),
            'recipes'   => Recipe::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function getEditPrize($id)
    {
        $prize = PrizeCode::find($id);
        if (!$prize) abort(404);
        return view('admin.prize_codes.create_edit_prize_code', [
            'prize'     => $prize,
            'items'     => Item::orderBy('name')->pluck('name', 'id'),
            'categories'=> ItemCategory::orderBy('name')->pluck('name', 'id'),
            'currencies'=> Currency::where('is_user_owned', 1)->orderBy('name')->pluck('name', 'id'),
            'tables'    => LootTable::orderBy('name')->pluck('name', 'id'),
            'raffles'   => Raffle::where('rolled_at', null)->where('is_active', 1)->orderBy('name')->pluck('name', 'id'),
            'pets'      => Pet::orderBy('name')->pluck('name', 'id'),
            'awards'    => Award::orderBy('name')->pluck('name', 'id'),
            'gear'      => Gear::orderBy('name')->pluck('name', 'id'),
            'weapons'   => Weapon::orderBy('name')->pluck('name', 'id'),
            'recipes'   => Recipe::orderBy('name')->pluck('name', 'id'),
            'redeemers' => $prize->redeemers,
        ]);
    }

    public function postCreateEditPrize(Request $request, PrizeCodeService $service, $id = null)
    {
        $data = $request->only([
            'name', 'code', 'description', 'image', 'remove_image', 'start_at', 'end_at', 'is_active',
            'rewardable_type', 'rewardable_id', 'reward_quantity', 'use_limit', 'regenerate'
        ]);
        if ($id && $service->updatePrize(PrizeCode::find($id), $data, Auth::user())) {
            flash('Prize updated successfully.')->success();
        } elseif (!$id && $prize = $service->createPrize($data, Auth::user())) {
            flash('Prize created successfully.')->success();
            return redirect()->to('admin/prizecodes/edit/' . $prize->id);
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    public function postGenerateKey(PrizeCodeService $service)
    {
        if ($service->generatePrize(Auth::user())) {
            flash('Generated prize successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

    public function getDeletePrize($id)
    {
        $prize = PrizeCode::find($id);
        return view('admin.prize_codes._delete_prize', ['prize' => $prize]);
    }

    public function postDeletePrize(PrizeCodeService $service, $id)
    {
        $prize = PrizeCode::find($id);
        if ($prize && $service->deletePrize($prize)) {
            flash('Deleted prize key successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->to('admin/prizecodes');
    }
}