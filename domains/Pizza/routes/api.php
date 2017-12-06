<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:14:25
 */

use Illuminate\Support\Facades\Route;

Route::post('/', 'CreatePizzaController@store')
    ->name('create-pizzas.create');

Route::get('/', 'ReadPizzaController@index')
    ->name('read-pizzas.read');

Route::patch('/{pizza}', 'UpdatePizzaController@update')
    ->name('update-pizzas.update');

Route::delete('/{pizza}', 'DeletePizzaController@destroy')
    ->name('delete-pizzas.delete');
