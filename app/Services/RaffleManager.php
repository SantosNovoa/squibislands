<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\Raffle\Raffle;
use App\Models\Raffle\RaffleTicket;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RaffleManager extends Service {
=======
<?php namespace App\Services;

use DB;
use Carbon\Carbon;
use App\Services\Service;
use App\Models\Raffle\RaffleGroup;
use App\Models\Raffle\Raffle;
use App\Models\Raffle\RaffleTicket;
use App\Models\User\User;

class RaffleManager extends Service 
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Raffle Manager
    |--------------------------------------------------------------------------
    |
    | Handles creation and modification of raffle ticket data.
    |
    */

    /**
<<<<<<< HEAD
     * Adds tickets to a raffle.
     *
     * @param Raffle $raffle
     * @param array  $data
     *
     * @return int
     */
    public function addTickets($raffle, $data) {
        $count = 0;
        foreach ($data['user_id'] as $key=> $id) {
            if ($user = User::where('id', $id)->first()) {
                if ($this->addTicket($user, $raffle, $data['ticket_count'][$key])) {
                    $count += $data['ticket_count'][$key];
                }
            } else {
                if ($this->addTicket($data['alias'][$key], $raffle, $data['ticket_count'][$key])) {
                    $count += $data['ticket_count'][$key];
                }
            }
        }

=======
     * Adds tickets to a raffle. 
     * One ticket is added per name in $names, which is a
     * string containing comma-separated names.
     *
     * @param  \App\Models\Raffle\Raffle $raffle
     * @param  string                    $names
     * @return int
     */
    public function addTickets($raffle, $names)
    {
        $names = explode(',', $names);
        $count = 0;
        foreach($names as $name)
        {
            $name = trim($name);
            if(strlen($name) == 0) continue;
            if ($user = User::where('name', $name)->first())
                $count += $this->addTicket($user, $raffle);
            else
                $count += $this->addTicket($name, $raffle);
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $count;
    }

    /**
     * Adds one or more tickets to a single user for a raffle.
     *
<<<<<<< HEAD
     * @param User   $user
     * @param Raffle $raffle
     * @param int    $count
     *
     * @return int
     */
    public function addTicket($user, $raffle, $count = 1) {
        if (!$user) {
            return 0;
        } elseif (!$raffle) {
            return 0;
        } elseif ($count == 0) {
            return 0;
        } elseif ($raffle->rolled_at != null) {
            return 0;
        } elseif ($raffle->ticket_cap > 0 && ((is_string($user) ? $raffle->tickets()->where('alias', $user)->count() : $raffle->tickets()->where('user_id', $user->id)->count()) > $raffle->ticket_cap || (is_string($user) ? $raffle->tickets()->where('alias', $user)->count() : $raffle->tickets()->where('user_id', $user->id)->count()) + $count > $raffle->ticket_cap)) {
            return 0;
        } else {
            DB::beginTransaction();
            $data = ['raffle_id' => $raffle->id, 'created_at' => Carbon::now()] + (is_string($user) ? ['alias' => $user] : ['user_id' => $user->id]);
            for ($i = 0; $i < $count; $i++) {
                RaffleTicket::create($data);
            }
            DB::commit();

            return 1;
        }

=======
     * @param  \App\Models\User\User     $user
     * @param  \App\Models\Raffle\Raffle $raffle
     * @param  int                       $count
     * @return int
     */
    public function addTicket($user, $raffle, $count = 1)
    {
        if (!$user) return 0;
        else if (!$raffle) return 0;
        else if ($count == 0) return 0;
        else if ($raffle->rolled_at != null) return 0;
        else {
            DB::beginTransaction();
            $data = ["raffle_id" => $raffle->id, 'created_at' => Carbon::now()] + (is_string($user) ? ['alias' => $user] : ['user_id' => $user->id]);
            for ($i = 0; $i < $count; $i++) RaffleTicket::create($data);
            DB::commit();
            return 1;
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return 0;
    }

    /**
     * Removes a single ticket.
     *
<<<<<<< HEAD
     * @param RaffleTicket $ticket
     *
     * @return bool
     */
    public function removeTicket($ticket) {
        if (!$ticket) {
            return null;
        } else {
            $ticket->delete();

            return true;
        }

=======
     * @param  \App\Models\Raffle\RaffleTicket $ticket
     * @return bool
     */
    public function removeTicket($ticket)
    {
        if (!$ticket) return null;
        else {
            $ticket->delete();
            return true;
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return false;
    }

    /**
     * Rolls a raffle group consecutively.
     * If the $updateGroup flag is true, winners will be removed
     * from other raffles in the group.
     *
<<<<<<< HEAD
     * @param \App\Models\Raffle\RaffleGroup $raffleGroup
     * @param bool                           $updateGroup
     *
     * @return bool
     */
    public function rollRaffleGroup($raffleGroup, $updateGroup = true) {
        if (!$raffleGroup) {
            return null;
        }
        DB::beginTransaction();
        foreach ($raffleGroup->raffles()->orderBy('order')->get() as $raffle) {
            if (!$this->rollRaffle($raffle, $updateGroup)) {
                DB::rollback();

=======
     * @param  \App\Models\Raffle\RaffleGroup $raffleGroup
     * @param  bool                           $updateGroup
     * @return bool
     */
    public function rollRaffleGroup($raffleGroup, $updateGroup = true)
    {
        if(!$raffleGroup) return null;
        DB::beginTransaction();
        foreach($raffleGroup->raffles()->orderBy('order')->get() as $raffle)
        {
            if (!$this->rollRaffle($raffle, $updateGroup)) 
            {
                DB::rollback();
>>>>>>> Cylunny/extension/polls-and-forms
                return false;
            }
        }
        $raffleGroup->is_active = 2;
        $raffleGroup->save();
        DB::commit();
<<<<<<< HEAD

        return true;
    }


    /**
     * Sends a Discord webhook notification when a raffle is rolled.
     *
     * @param Raffle $raffle
     * @param array  $winners
     * @return void
     */
    private function notifyDiscordRaffleComplete($raffle, $winners) {
        $webhookUrl = config('app.discord_webhook_url');
        if (!$webhookUrl) return;

        try {
            // Build winner display list
            $winnerNames = [];
            foreach ($winners['ids'] as $userId) {
                $user = User::find($userId);
                if ($user) $winnerNames[] = $user->name;
            }
            foreach ($winners['aliases'] as $alias) {
                $winnerNames[] = $alias . ' (off-site)';
            }

            $winnerList = !empty($winnerNames) 
                ? implode(', ', $winnerNames) 
                : 'No winners';

            Http::post($webhookUrl, [
                'embeds' => [[
                    'title'       => '🎉 Raffle Complete: ' . $raffle->name,
                    'url'         => $raffle->url,
                    'description' => '**Winner(s):** ' . $winnerList,
                    'color'       => 0x2179e0,
                    'timestamp'   => $raffle->rolled_at->toIso8601String(),
                ]],
            ]);
        } catch (\Exception $e) {
            Log::warning('Discord raffle webhook failed: ' . $e->getMessage());
        }
    }

=======
        return true;
    }

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Rolls a single raffle and marks it as completed.
     * If the $updateGroup flag is true, winners will be removed
     * from other raffles in the group.
     *
<<<<<<< HEAD
     * @param Raffle $raffle
     * @param bool   $updateGroup
     *
     * @return bool
     */
    public function rollRaffle($raffle, $updateGroup = false) {
        if (!$raffle) {
            return null;
        }
        DB::beginTransaction();
        // roll winners
        if ($winners = $this->rollWinners($raffle)) {
=======
     * @param  \App\Models\Raffle\Raffle $raffle
     * @param  bool                      $updateGroup
     * @return bool
     */
    public function rollRaffle($raffle, $updateGroup = false) 
    {
        if(!$raffle) return null;
        DB::beginTransaction();
        // roll winners
        if($winners = $this->rollWinners($raffle))
        {
>>>>>>> Cylunny/extension/polls-and-forms
            // mark raffle as finished
            $raffle->is_active = 2;
            $raffle->rolled_at = Carbon::now();
            $raffle->save();

            // updates the raffle group if necessary
<<<<<<< HEAD
            if ($updateGroup && !$this->afterRoll($winners, $raffle->group, $raffle)) {
                DB::rollback();

                return false;
            }

            $this->notifyDiscordRaffleComplete($raffle, $winners);

            DB::commit();

            return true;
        }
        DB::rollback();

=======
            if($updateGroup && !$this->afterRoll($winners, $raffle->group, $raffle))
            {
                DB::rollback();
                return false;
            }
            DB::commit();
            return true;
        }
        DB::rollback();
>>>>>>> Cylunny/extension/polls-and-forms
        return false;
    }

    /**
     * Rolls the winners of a raffle.
     *
<<<<<<< HEAD
     * @param Raffle $raffle
     *
     * @return array
     */
    private function rollWinners($raffle) {
        $ticketPool = $raffle->tickets;
        $ticketCount = $ticketPool->count();
        $winners = ['ids' => [], 'aliases' => []];
        for ($i = 0; $i < $raffle->winner_count; $i++) {
            if ($ticketCount == 0) {
                break;
            }
=======
     * @param  \App\Models\Raffle\Raffle $raffle
     * @return array
     */
    private function rollWinners($raffle)
    {
        $ticketPool = $raffle->tickets;
        $ticketCount = $ticketPool->count();
        $winners = ['ids' => [], 'aliases' => []];
        for ($i = 0; $i < $raffle->winner_count; $i++)
        {
            if($ticketCount == 0) break;
>>>>>>> Cylunny/extension/polls-and-forms

            $num = mt_rand(0, $ticketCount - 1);
            $winner = $ticketPool[$num];

            // save ticket position as ($i + 1)
            $winner->update(['position' => $i + 1]);

            // save the winning ticket's user id
<<<<<<< HEAD
            if (isset($winner->user_id)) {
                $winners['ids'][] = $winner->user_id;
            } else {
                $winners['aliases'][] = $winner->alias;
            }
=======
            if(isset($winner->user_id)) $winners['ids'][] = $winner->user_id;
            else $winners['aliases'][] = $winner->alias;
>>>>>>> Cylunny/extension/polls-and-forms

            // remove ticket from the ticket pool after pulled
            $ticketPool->forget($num);
            $ticketPool = $ticketPool->values();

            $ticketCount--;

            // remove tickets for the same user...I'm unsure how this is going to hold up with 3000 tickets,
<<<<<<< HEAD
            foreach ($ticketPool as $key=> $ticket) {
                if (($ticket->user_id != null && $ticket->user_id == $winner->user_id) || ($ticket->user_id == null && $ticket->alias == $winner->alias)) {
                    $ticketPool->forget($key);
                }
=======
            foreach($ticketPool as $key=>$ticket)
            {
                if(($ticket->user_id != null && $ticket->user_id == $winner->user_id) || ($ticket->user_id == null && $ticket->alias == $winner->alias)) 
                {
                    $ticketPool->forget($key);
                }

>>>>>>> Cylunny/extension/polls-and-forms
            }
            $ticketPool = $ticketPool->values();
            $ticketCount = $ticketPool->count();
        }
<<<<<<< HEAD

=======
>>>>>>> Cylunny/extension/polls-and-forms
        return $winners;
    }

    /**
     * Rolls the winners of a raffle.
     *
<<<<<<< HEAD
     * @param array                          $winners
     * @param \App\Models\Raffle\RaffleGroup $raffleGroup
     * @param Raffle                         $raffle
     *
     * @return bool
     */
    private function afterRoll($winners, $raffleGroup, $raffle) {
        // remove any tickets from winners in raffles in the group that aren't completed
        $raffles = $raffleGroup->raffles()->where('is_active', '!=', 2)->where('id', '!=', $raffle->id)->get();
        foreach ($raffles as $r) {
            $r->tickets()->where(function ($query) use ($winners) {
                $query->whereIn('user_id', $winners['ids'])->orWhereIn('alias', $winners['aliases']);
            })->delete();
        }

        return true;
    }
=======
     * @param  array                          $winners
     * @param  \App\Models\Raffle\RaffleGroup $raffleGroup
     * @param  \App\Models\Raffle\Raffle      $raffle
     * @return bool
     */
    private function afterRoll($winners, $raffleGroup, $raffle)
    {
        // remove any tickets from winners in raffles in the group that aren't completed
        $raffles = $raffleGroup->raffles()->where('is_active', '!=', 2)->where('id', '!=', $raffle->id)->get();
        foreach($raffles as $r)
        {
            $r->tickets()->where(function($query) use ($winners) { 
                $query->whereIn('user_id', $winners['ids'])->orWhereIn('alias', $winners['aliases']); 
            })->delete();
        }
        return true;
    }


>>>>>>> Cylunny/extension/polls-and-forms
}
