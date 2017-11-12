<?php

use Illuminate\Support\Facades\Route;

Route::get('/token/{user}', function (\App\User $user) {
    return $user;
});

Route::middleware('auth')->get('/info', function () {

});