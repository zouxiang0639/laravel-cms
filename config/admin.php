<?php

return [
    'views' => [
        'layout' => 'admin.layouts.master',
        'prefix' => 'admin'
    ],
    'filter' => [
        'auth' => [
            App\Http\Middleware\Authenticate::class,
        ],
    ],
    'image' => [
        'default' => 'images/default-picture.png'
    ]
];
