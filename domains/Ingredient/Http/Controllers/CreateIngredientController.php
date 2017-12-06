<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 5/12/2017
 * Hora: 5:36:53
 */

namespace Ingredient\Http\Controllers;

use Ingredient\Http\Requests\CreateIngredientRequest;

class CreateIngredientController extends Controller
{
    /**
     * @param CreateIngredientRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(CreateIngredientRequest $request)
    {
        $ingredient = $this->ingredientRepository->create($request->all());

        return response($ingredient);
    }
}