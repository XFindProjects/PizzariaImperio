<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 6/12/2017
 * Hora: 11:31:15
 */

namespace Ingredient\Http\Controllers;

use Ingredient\Models\Ingredient;

class DeleteIngredientController extends Controller
{
    public function destroy(Ingredient $ingredient)
    {
        $this->authorize('delete', $ingredient);

        $this->ingredientRepository->deleteModel($ingredient);

        return response([
            'message' => __('Ingredient::responses.ingredient-deleted')
        ]);
    }
}