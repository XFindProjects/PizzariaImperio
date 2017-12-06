<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:14:1
 */

use Illuminate\Support\Facades\Route;

Route::post('/', 'CreateSizeController@store')
    ->name('create-sizes.create');

Route::get('/', 'ReadSizeController@index')
    ->name('read-sizes.read');

Route::patch('/{size}', 'UpdateSizeController@update')
    ->name('update-sizes.update');

Route::delete('/{size}', 'DeleteSizeController@destroy')
    ->name('delete-sizes.delete');