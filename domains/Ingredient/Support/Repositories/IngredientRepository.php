<?php

namespace Ingredient\Support\Repositories;

use Ingredient\Models\Ingredient;
use Model\Support\Repositories\BaseRepository;

class IngredientRepository extends BaseRepository
{
    public function getModel(): string
    {
        return Ingredient::class;
    }
}