<?php
Route::group(['prefix'=>'file', 'middleware' => config('admin.filter.auth')], function () {
    Route::post("/store", ['uses' => "Admin\\FileController@store", 'as' => 'admin.file.store']);
});