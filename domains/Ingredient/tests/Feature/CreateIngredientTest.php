<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:24:41
 */

namespace Ingredient\Tests\Feature;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Ingredient\Models\Ingredient;
use Tests\TestCase;

class CreateIngredientTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_users_cannot_hit_the_create_ingredients_endpoint()
    {
        $this->createEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_users_with_the_wrong_role_cannot_create_ingredients()
    {
        $this->signInAndSetToken(null, [
           'role' => config('acl.roles.garcons')
        ]);

        $this->createEndpoint([], $this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');
    }

    public function test_authenticated_users_with_the_right_role_can_create_ingredients()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $ingredient = make(Ingredient::class);
        $slug = SlugService::createSlug(Ingredient::class, 'slug', $ingredient['name'], ['unique' => 'false']);
        $this->createEndpoint($ingredient->toArray(), $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee($slug);

        $this->assertDatabaseHas('ingredients', $ingredient->toArray());
    }

    public function test_name_is_required_for_creating_ingredient()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $this->createEndpoint([], $this->generateAuthHeaders())
            ->assertStatus(422)
            ->assertJsonStructure([
                "message",
                "errors" => [
                    "name"
                ]
            ]);

        $attributes = ['name' => 'ingredient'];
        $this->createEndpoint($attributes, $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee($attributes['name']);

        $this->assertDatabaseHas('ingredients', $attributes);
    }

    public function createEndpoint($attributes = [], $headers = [])
    {
        return $this->postJson(Ingredient::getPath('create'), $attributes, $headers);
    }
}