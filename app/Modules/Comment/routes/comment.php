<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// post routes
Route::group([
    'namespace' => 'Modules\Comment\Http\Controllers',
    'middleware' => 'auth:api',
    'prefix' => 'api/comment'

], function () {
    Route::post('store','CommentController@store');
});
