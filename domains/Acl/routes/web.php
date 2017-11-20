<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:13:19
 */

use Illuminate\Support\Facades\Route;

Route::get('/token', 'CreateTokenController@token')->name('get-user.token');
Route::get('/', 'ReadUsersController@index')->name('read-users.view');
Route::get('/usuario/criar', 'CreateUsersController@index')->name('create-user.view');
Route::get('/{user}/', 'UpdateUsersController@index')->name('update-user.view');
