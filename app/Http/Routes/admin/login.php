<?php

Route::resource('login', 'Admin\\User\\LoginController', [
    'only' => ['store', 'index'],
    'names' => [
        'store' => 'admin.login.store',
    ],
]);

