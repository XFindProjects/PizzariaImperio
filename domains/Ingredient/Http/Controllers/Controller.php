<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 22:10:15
 */

namespace Ingredient\Http\Controllers;

use Ingredient\Support\Repositories\IngredientRepository;
use Pizzaria\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var IngredientRepository
     */
    public $ingredientRepository;

    /**
     * CreateIngredientController constructor.
     * @param IngredientRepository $ingredientRepository
     */
    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }
}