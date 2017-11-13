<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'ReadUsersController@index');
Route::get('/usuario/criar', 'CreateUsersController@index');
Route::get('/{user}/', 'UpdateUsersController@index');
