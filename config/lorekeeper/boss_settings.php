<?php

return [
    'methods' => [
        'prompt' => [
            'name' => 'Prompt Submissions',
            'description' => 'Submitting to a designated prompt, prompt category, or ANY prompt deals damage determined by staff.',
        ],
        // 'earned_currency' => [
        //     'name' => 'Earning Specified Currency',
        //     'description' => 'Earning the specified currency deals damage.',
        // ],
        'donate_currency' => [
            'name' => 'Donating  Currency',
            'description' => 'Donating currency to the boss deals damage.'
        ],
        'daily_login' => [
            'name' => 'Daily Login',
            'description' => 'Logging in daily deals damage, as long as the user interacts with the boss.',
        ],
        'donate_item' => [
            'name' => 'Donating Items',
            'description' => 'Donating items to the boss deals damage.',
        ],
        // 'donation_shop' => [
        //     'name' => 'Donation Shop',
        //     'description' => 'Donating items from the donation shop deals damage.',
        // ],
    ],

    // if you want to display rewards before the threshold is met
    'show_rewards_before_threshold' => true,

    // how many players should be displayed on the leaderboard
    'leaderboard_limit' => 5,
];