<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('user', 'CreateUsersController@store')
        ->name('create-users.store')
        ->middleware('auth:api');

    Route::patch('user/{user}', 'UpdateUsersController@update')
        ->name('update-users.update')
        ->middleware('auth:api');
});