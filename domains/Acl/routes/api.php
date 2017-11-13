<?php

use Illuminate\Support\Facades\Route;

Route::post('user', 'CreateUsersController@store')->name('create-users.store');