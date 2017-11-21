<?php

namespace Ingredient\Traits;

trait Ingredientable
{
    public function ingredients()
    {
        return $this->morphToMany(Ingredient::class, 'ingredientable');
    }
}