<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 6/12/2017
 * Hora: 10:51:16
 */

namespace Ingredient\Http\Controllers;

use Ingredient\Http\Requests\UpdateIngredientRequest;
use Ingredient\Models\Ingredient;

class UpdateIngredientController extends Controller
{
    public function update(Ingredient $ingredient, UpdateIngredientRequest $request)
    {
        $ingredient = $this->ingredientRepository->updateModel($ingredient, $request->only(['name']));

        return response($ingredient);
    }
}