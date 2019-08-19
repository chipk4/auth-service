<?php

return [
    'defaults' => [
        'guard' => 'token'
    ],
    'guards' => [
        'token' => [
            // access_token is what we defined inside Auth::extend
            // you can name this anything BUT should match with
            // Auth::extend('HERE');
            'driver' => 'access_token',
        ],
    ]
];
