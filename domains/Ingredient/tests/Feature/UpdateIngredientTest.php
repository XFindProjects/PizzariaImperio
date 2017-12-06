<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 6/12/2017
 * Hora: 10:49:52
 */

namespace Ingredient\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Ingredient\Models\Ingredient;
use Tests\TestCase;

class UpdateIngredientTest extends TestCase
{
    use DatabaseMigrations;

    private $ingredient;

    protected function setUp()
    {
        parent::setUp();
        $this->ingredient = create(Ingredient::class);
    }

    public function test_unauthenticated_users_cannot_hit_update_endpoint()
    {
        $this->updateEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_users_with_the_wrong_role_cannot_update_ingredients()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $ingredient = make(Ingredient::class);
        $this->updateEndpoint($ingredient->toArray(), $this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');

        $this->assertDatabaseHas('ingredients', [
            'name' => $this->ingredient->name
        ]);
   }

    public function test_authenticated_users_with_the_right_role_can_update_ingredients()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $ingredient = make(Ingredient::class);
        $this->updateEndpoint($ingredient->toArray(), $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee($this->ingredient->slug);

        $this->assertDatabaseHas('ingredients', [
            'id' => $this->ingredient->id,
            'name' => $ingredient->name
        ]);
   }

    public function updateEndpoint($attributes = [], $headers = [])
    {
        return $this->patchJson($this->ingredient->path('update'), $attributes, $headers);
    }
}