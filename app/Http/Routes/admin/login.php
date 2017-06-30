<?php

Route::resource('login', 'Admin\\LoginController', [
    'only' => ['store', 'index'],
    'names' => [
        'store' => 'admin.login.store',
    ],
]);

