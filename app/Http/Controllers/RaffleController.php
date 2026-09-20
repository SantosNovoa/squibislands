<<<<<<< HEAD
<?php

namespace App\Http\Controllers;

use App\Models\Raffle\Raffle;
use App\Models\Raffle\RaffleGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class RaffleController extends Controller {
=======
<?php namespace App\Http\Controllers;

use Auth;
use Request; 
use App\Models\Raffle\RaffleGroup;
use App\Models\Raffle\Raffle;
use App\Models\Raffle\RaffleTicket;

class RaffleController extends Controller
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Raffle Controller
    |--------------------------------------------------------------------------
    |
    | Displays raffles and raffle tickets.
    |
    */

    /**
     * Shows the raffle index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
<<<<<<< HEAD
    public function getRaffleIndex() {
        $raffles = Raffle::query();
        if (Request::get('view') == 'completed') {
            $raffles->where('is_active', 2);
        } else {
            $raffles->where('is_active', '=', 1);
        }
=======
    public function getRaffleIndex()
    {
        $raffles = Raffle::query();
        if (Request::get('view') == 'completed') $raffles->where('is_active', 2);
        else $raffles->where('is_active', '=', 1);
>>>>>>> Cylunny/extension/polls-and-forms
        $raffles = $raffles->orderBy('group_id')->orderBy('order');

        return view('raffles.index', [
            'raffles' => $raffles->get(),
<<<<<<< HEAD
            'groups'  => RaffleGroup::whereIn('id', $raffles->pluck('group_id')->toArray())->get()->keyBy('id'),
=======
            'groups' => RaffleGroup::whereIn('id', $raffles->pluck('group_id')->toArray())->get()->keyBy('id')
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }

    /**
     * Shows tickets for a given raffle.
     *
<<<<<<< HEAD
     * @param int $id
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getRaffleTickets($id) {
        $raffle = Raffle::find($id);
        if (!$raffle || !$raffle->is_active) {
            abort(404);
        }
=======
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getRaffleTickets($id)
    {
        $raffle = Raffle::find($id);
        if(!$raffle || !$raffle->is_active) abort(404);
>>>>>>> Cylunny/extension/polls-and-forms
        $userCount = Auth::check() ? $raffle->tickets()->where('user_id', Auth::user()->id)->count() : 0;
        $count = $raffle->tickets()->count();

        return view('raffles.ticket_index', [
<<<<<<< HEAD
            'raffle'    => $raffle,
            'tickets'   => $raffle->tickets()->with('user')->orderBy('id')->paginate(100),
            'count'     => $count,
            'userCount' => $userCount,
            'page'      => Request::get('page') ? Request::get('page') - 1 : 0,
=======
            'raffle' => $raffle,
            'tickets' => $raffle->tickets()->with('user')->orderBy('id')->paginate(100),
            'count' => $count,
            'userCount' => $userCount, 
            "page" => Request::get('page') ? Request::get('page') - 1 : 0
>>>>>>> Cylunny/extension/polls-and-forms
        ]);
    }
}
