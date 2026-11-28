<?php

namespace App\Console\Commands;

use App\Models\FetchQuest\FetchQuest;
use Illuminate\Console\Command;

class ChangeFetchItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change-fetch-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changes currently wanted fetch item.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        //fetch all fetch quests so we can update them
        $fetches = FetchQuest::all();
        foreach ($fetches as $fetch) {
            // If an admin has chosen specific items for this quest, only roll from those (with their amount ranges)
            if ($fetch->wantedItems()->count()) {
                if (!$fetch->rollWantedItem()) {
                    $this->warn('Fetch quest #'.$fetch->id.' ('.$fetch->name.') has no valid wanted items; skipping.');
                    continue;
                }
                $this->rollCurrencyRange($fetch);
                continue;
            }

            // Otherwise pick a random item from the category (or all items), minus exceptions
            if (!$fetch->rollRandomItem()) {
                // skip this quest instead of stopping the whole run, so the other quests still roll
                $this->warn('Fetch quest #'.$fetch->id.' ('.$fetch->name.') has no items to select from; skipping.');
                continue;
            }

            $this->rollCurrencyRange($fetch);

        }

    }

    /**
     * Randomizes the quest's current currency reward range, if all four reward settings are set.
     *
     * @param FetchQuest $fetch
     */
    private function rollCurrencyRange($fetch)
    {
        if (isset($fetch->extras['reward_min_min']) && isset($fetch->extras['reward_min_max']) && isset($fetch->extras['reward_max_min']) && isset($fetch->extras['reward_max_max'])) {
            //start with rand the min
            $roll2 = mt_rand($fetch->extras['reward_min_min'], $fetch->extras['reward_min_max']);
            //rand the max
            $roll3 = mt_rand($fetch->extras['reward_max_min'], $fetch->extras['reward_max_max']);
            //set the value.
            $fetch->current_min = $roll2;
            $fetch->current_max = $roll3;
            $fetch->save();
        }
    }
}
