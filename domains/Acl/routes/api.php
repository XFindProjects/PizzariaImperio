<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('user', 'CreateUsersController@store')
        ->name('create-users.store');

    Route::patch('user/{user}', 'UpdateUsersController@update')
        ->name('update-users.update');

    Route::get('/users', 'ReadUsersController@index')
        ->name('read-users.read');

    Route::delete('/user/{user}', 'DeleteUsersController@destroy')
        ->name('delete-users.delete');
});