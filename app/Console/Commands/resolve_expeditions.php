<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Expedition\ExpeditionLog;
use Carbon\Carbon;

class resolve_expeditions extends Command
{
    protected $signature = 'resolve-expeditions';

    protected $description = 'Resolves expeditions that have finished their timer, rolling one combined success check per trip.';

    public function handle()
    {
        $logs = ExpeditionLog::where('is_processed', 0)
            ->where('completes_at', '<=', Carbon::now())
            ->get();

        foreach ($logs as $log) {
            $characterCount = $log->characters()->count();
            $chance = min($characterCount * $log->expedition->success_rate, 100);

            $roll = mt_rand(0, 10000) / 100;
            $log->success = $roll <= $chance;
            $log->is_processed = 1;
            $log->save();
        }
    }
}