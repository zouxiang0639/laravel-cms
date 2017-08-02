<?php
Route::group(['prefix'=>'log', 'middleware' => config('admin.filter.auth')], function () {

    Route::group(['prefix'=>'system-error'], function () {
        Route::get("/", ['uses' => "\\Rap2hpoutre\\LaravelLogViewer\\LogViewerController@index", 'as' => 'admin.log.system-error']);
    });
});

