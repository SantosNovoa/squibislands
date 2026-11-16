<?php

/*
|--------------------------------------------------------------------------
| Dashboard Shortcuts
|--------------------------------------------------------------------------
|
| The icon shortcuts beside Recent News on the dashboard.
| Each one can be switched on/off in Admin > Event Banners (stored in site_settings
| as dashboard_shortcut_{key}_active). Icons are uploaded in Admin > Site Images
| using image_key; until one is uploaded the Font Awesome icon is shown.
| url is a path, passed through url() when rendered.
|
*/

return [
    'dailies' => [
        'label'     => 'Dailies',
        'icon'      => 'far fa-calendar-check',
        'url'       => 'dailies',
        'image_key' => 'dashboard_dailies',
    ],
    'shops' => [
        'label'     => 'Shops',
        'icon'      => 'fas fa-coins',
        'url'       => 'shops',
        'image_key' => 'dashboard_shops',
    ],
    'prompts' => [
        'label'     => 'Prompts',
        'icon'      => 'fas fa-pen-nib',
        'url'       => 'prompts/prompts',
        'image_key' => 'dashboard_prompts',
    ],
    'inventory' => [
        'label'     => 'Inventory',
        'icon'      => 'fas fa-box-open',
        'url'       => 'inventory',
        'image_key' => 'dashboard_inventory',
    ],
];
