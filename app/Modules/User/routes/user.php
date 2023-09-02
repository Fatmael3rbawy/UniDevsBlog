<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// auth routes
Route::group([
    'namespace' => 'Modules\User\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'api/auth'

], function () {
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::get('my-profile', 'AuthController@myProfile');

});
