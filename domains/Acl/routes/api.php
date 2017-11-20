<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:13:38
 */

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