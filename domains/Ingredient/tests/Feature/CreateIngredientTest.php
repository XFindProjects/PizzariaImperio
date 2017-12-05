<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:24:41
 */

namespace Ingredient\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Ingredient\Models\Ingredient;
use Tests\TestCase;

class CreateIngredientTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_users_cannot_hit_the_create_ingredients_endpoint()
    {

    }

    public function createEndpoint($attributes = [], $headers = [])
    {
        return $this->postJson(Ingredient::path('create'), $attributes);
    }
}