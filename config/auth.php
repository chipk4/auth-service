<?php

return [
    'defaults' => [
        'guard' => 'token'
    ],
    'guards' => [
        'token' => [
            'driver' => 'access_token',
        ],
        'optional_auth' => [
            'driver' => 'optional_auth'
        ]
    ]
];
