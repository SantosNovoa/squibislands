<?php

namespace App\Http\Controllers\Admin\Users;

<<<<<<< HEAD
use App\Http\Controllers\Controller;
use App\Models\Rank\Rank;
use App\Models\Theme;
use App\Services\RankService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
=======
use Auth;
use Config;
use Illuminate\Http\Request;
use App\Models\Rank\Rank;
use App\Services\RankService;

use App\Http\Controllers\Controller;
>>>>>>> Cylunny/extension/polls-and-forms

class RankController extends Controller
{
    /**
     * Show the rank index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        return view('admin.users.ranks', [
<<<<<<< HEAD
            'ranks' => Rank::orderBy('sort', 'DESC')->get(),
=======
            'ranks' => Rank::orderBy('sort', 'DESC')->get()
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Get the rank creation modal.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCreateRank()
    {
        return view('admin.users._create_edit_rank', [
<<<<<<< HEAD
            'rank'       => new Rank,
            'rankPowers' => null,
            'powers'     => config('lorekeeper.powers'),
            'editable'   => 1,
            'themes'     => Theme::where('is_active', 1)->orderBy('name')->get(),
=======
            'rank' => new Rank,
            'rankPowers' => null,
            'powers' => Config::get('lorekeeper.powers'),
            'editable' => 1
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Get the rank editing modal.
     *
<<<<<<< HEAD
     * @param mixed $id
     *
=======
>>>>>>> Cylunny/extension/polls-and-forms
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEditRank($id)
    {
        $rank = Rank::find($id);
        $editable = Auth::user()->canEditRank($rank);
<<<<<<< HEAD
        if (!$editable) {
            $rank = null;
        }

        if ($rank) {
            $rank->load('themeColors');
        }

        return view('admin.users._create_edit_rank', [
            'rank'       => $rank,
            'powers'     => config('lorekeeper.powers'),
            'rankPowers' => $rank ? $rank->getPowers() : null,
            'editable'   => $editable,
            'themes'     => Theme::where('is_active', 1)->orderBy('name')->get(),
        ]);
    }

    /**
     * Handle rank creation and editing.
     *
     * @param mixed $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateEditRank(Request $request, RankService $service, $id = null)
    {
        $request->validate(Rank::$rules);
        $data = $request->only(['name', 'description', 'color', 'powers', 'icon', 'theme_colors']);

        if ($id && $service->updateRank(Rank::find($id), $data, Auth::user())) {
            flash('Rank updated successfully.')->success();
        } elseif (!$id && $service->createRank($data, Auth::user())) {
            flash('Rank created successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Get the rank deletion modal.
     *
     * @param mixed $id
     *
=======
        if(!$editable) $rank = null;
        return view('admin.users._create_edit_rank', [
            'rank' => $rank,
            'rankPowers' => $rank ? $rank->getPowers() : null,
            'powers' => Config::get('lorekeeper.powers'),
            'editable' => $editable
        ]);
    }

    public function postCreateEditRank(Request $request, RankService $service, $id = null)
    {
        $request->validate(Rank::$rules);
        $data = $request->only(['name', 'description', 'color', 'powers', 'icon']);
        if($id && $service->updateRank(Rank::find($id), $data, Auth::user())) {
            flash('Rank updated successfully.')->success();
        }
        else if ($service->createRank($data, Auth::user())) {
            flash('Rank created successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
    
    /**
     * Get the rank deletion modal.
     *
>>>>>>> Cylunny/extension/polls-and-forms
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDeleteRank($id)
    {
        $rank = Rank::find($id);
        $editable = Auth::user()->canEditRank($rank);
<<<<<<< HEAD
        if (!$editable) {
            $rank = null;
        }

        return view('admin.users._delete_rank', [
            'rank'     => $rank,
            'editable' => $editable,
        ]);
    }

    /**
     * Handle rank deletion.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeleteRank(Request $request, RankService $service, $id)
    {
        if ($id && $service->deleteRank(Rank::find($id), Auth::user())) {
            flash('Rank deleted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Handle rank sorting.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSortRanks(Request $request, RankService $service)
    {
        if ($service->sortRanks($request->get('sort'), Auth::user())) {
            flash('Ranks sorted successfully.')->success();
        } else {
            foreach ($service->errors()->getMessages()['error'] as $error) {
                flash($error)->error();
            }
        }

        return redirect()->back();
    }
=======
        if(!$editable) $rank = null;
        return view('admin.users._delete_rank', [
            'rank' => $rank,
            'editable' => $editable
        ]);
    }

    public function postDeleteRank(Request $request, RankService $service, $id)
    {
        if($id && $service->deleteRank(Rank::find($id), Auth::user())) {
            flash('Rank deleted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }
    
    public function postSortRanks(Request $request, RankService $service)
    {
        if($service->sortRanks($request->get('sort'), Auth::user())) {
            flash('Ranks sorted successfully.')->success();
        }
        else {
            foreach($service->errors()->getMessages()['error'] as $error) flash($error)->error();
        }
        return redirect()->back();
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
