<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "redis", "log", "null"
    |
    */

<<<<<<< HEAD
    'default'     => env('BROADCAST_DRIVER', 'null'),
=======
    'default' => env('BROADCAST_DRIVER', 'null'),
>>>>>>> Cylunny/extension/polls-and-forms

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
<<<<<<< HEAD
            'driver'  => 'pusher',
            'key'     => env('PUSHER_APP_KEY'),
            'secret'  => env('PUSHER_APP_SECRET'),
            'app_id'  => env('PUSHER_APP_ID'),
            'options' => [
                'cluster'   => env('PUSHER_APP_CLUSTER'),
=======
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
>>>>>>> Cylunny/extension/polls-and-forms
                'encrypted' => true,
            ],
        ],

<<<<<<< HEAD
        'redis'  => [
            'driver'     => 'redis',
            'connection' => 'default',
        ],

        'log'    => [
            'driver' => 'log',
        ],

        'null'   => [
=======
        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
>>>>>>> Cylunny/extension/polls-and-forms
            'driver' => 'null',
        ],

    ],

];
