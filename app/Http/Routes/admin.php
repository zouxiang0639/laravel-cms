<?php
Route::group(['prefix'=>'admin'], function(){

    require 'admin/login.php';
    require 'admin/public.php';

});