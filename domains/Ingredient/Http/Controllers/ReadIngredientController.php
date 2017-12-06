<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 5/12/2017
 * Hora: 5:36:53
 */

namespace Ingredient\Http\Controllers;

use Ingredient\Models\Ingredient;

class ReadIngredientController extends Controller
{
    public function index()
    {
        $this->authorize('view', Ingredient::class);

        $ingredients = $this->ingredientRepository->orderBy('name', 'asc')->paginate(20);

        return response($ingredients);
    }
}