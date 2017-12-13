<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 6/12/2017
 * Hora: 11:28:49
 */

namespace Ingredient\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Ingredient\Models\Ingredient;
use Tests\TestCase;

class DeleteIngredientTest extends TestCase
{
    use DatabaseMigrations;

    private $ingredient;

    protected function setUp()
    {
        parent::setUp();
        $this->ingredient = create(Ingredient::class);
    }

    public function test_unauthenticated_users_cannot_hit_the_delete_ingredients_endpoint()
    {
        $this->deleteEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_users_with_the_wrong_role_cannot_delete_ingredients()
    {

        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $this->deleteEndpoint($this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');
    }

    public function test_authenticated_users_with_the_right_role_can_delete_ingredients()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $this->deleteEndpoint($this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee(__('Ingredient::responses.ingredient-deleted'));

        $this->assertSoftDeleted('ingredients', [
            'slug' => $this->ingredient->slug
        ]);
    }

    public function deleteEndpoint($headers = [])
    {
        return $this->deleteJson($this->ingredient->path('delete'), [], $headers);
    }
}