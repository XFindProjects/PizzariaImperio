<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 18/11/2017
 * Hora: 2:14:25
 */

use Illuminate\Support\Facades\Route;

Route::post('/', 'CreateIngredientController@store')
    ->name('create-ingredients.create');

Route::get('/', 'ReadIngredientController@index')
    ->name('read-ingredients.read');

Route::patch('/{ingredient}', 'UpdateIngredientController@update')
    ->name('update-ingredients.update');

Route::delete('/{ingredient}', 'DeleteIngredientController@destroy')
    ->name('delete-ingredients.delete');
