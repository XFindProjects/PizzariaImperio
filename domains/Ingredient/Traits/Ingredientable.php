<?php

namespace Ingredient\Traits;

use Ingredient\Models\Ingredient;

trait Ingredientable
{
    public function ingredients()
    {
        return $this->morphToMany(Ingredient::class, 'ingredientable');
    }
}