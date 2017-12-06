<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 6/12/2017
 * Hora: 10:3:52
 */

namespace Ingredient\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Ingredient\Models\Ingredient;
use Tests\TestCase;

class ReadIngredientTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_users_cannot_hit_the_read_ingredients_endpoint()
    {
        $this->readEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_users_with_the_any_role_can_read_ingredients()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $ingredient = create(Ingredient::class);
        $this->readEndpoint($this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee($ingredient->slug);

    }

    public function test_rigth_structure_on_response()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $ingredient = create(Ingredient::class);
        $this->readEndpoint($this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee($ingredient->slug)
            ->assertJsonStructure($this->generatePaginationJsonStructure());

    }

    public function readEndpoint($headers = [])
    {
        return $this->getJson(Ingredient::getPath('read'), $headers);
    }
}