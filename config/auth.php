<?php

return [
    'defaults' => [
        'guard' => 'token'
    ],
    'guards' => [
        'token' => [
            'driver' => 'access_token',
        ],
    ]
];
