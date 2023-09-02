<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// post routes
Route::group([
    'namespace' => 'Modules\Post\Http\Controllers',
    'middleware' => 'auth:api',
    'prefix' => 'api/post'

], function () {
    Route::get('index','PostController@index');
    Route::post('store','PostController@store');
    Route::post('update','PostController@update');
    Route::post('destroy','PostController@destroy');

});
