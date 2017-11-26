<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:48:59
 */

use Illuminate\Support\Facades\Route;

Route::post('/', 'CreateTableController@store')
    ->name('create-tables.store');

Route::get('/', 'ReadTableController@read')
    ->name('read-tables.read');

Route::get('/mesa-{table}/orders', 'ReadTableController@orders')
    ->name('read-tables.orders');

Route::delete('/mesa-{table}', 'DeleteTableController@destroy')
    ->name('delete-tables.delete');