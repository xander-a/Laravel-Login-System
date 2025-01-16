<?php

use Illuminate\Support\Facades\Route;

// Test route
Route::get('/hello', function () {
    return 'Hello World';
});

// User routes
Route::get('/user', ['as' => 'user.index', 'uses' => 'App\Http\Controllers\UserController@index']);
Route::get('/user/register', ['as' => 'user.register', 'uses' => 'App\Http\Controllers\UserController@register']);
Route::post('/user/store', ['as' => 'user.store', 'uses' => 'App\Http\Controllers\UserController@store']);
Route::get('/user/login', ['as' => 'user.login', 'uses' => 'App\Http\Controllers\UserController@login']);
Route::post('/user/authenticate', ['as' => 'user.authenticate', 'uses' => 'App\Http\Controllers\UserController@authenticate']);
Route::get('/user/logout', ['as' => 'user.logout', 'uses' => 'App\Http\Controllers\UserController@logout']);
Route::get('/user/account', ['as' => 'user.account', 'uses' => 'App\Http\Controllers\UserController@account']);

