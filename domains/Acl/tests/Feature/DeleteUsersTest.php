<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 23:33:33
 */

namespace Acl\Tests\Feature;

use Pizzaria\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteUsersTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = User::generate();
    }

    /**
     *  Test if unauthenticated users cannot hit the delete eendpoint
     */
    public function test_unauthenticated_users_cannot_hit_the_delete_users_endpoint()
    {
        $user = User::generate();

        $this->deleteUsersJsonEndpoint($user, $this->generateAuthHeaders())
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    /**
     *  Test if authenticated users with a role witch is not admin cannot delete users
     */
    public function test_authenticated_users_without_the_admin_role_cannot_delete_users()
    {

        $this->signInAndSetToken(null, [
           'role' => config('acl.roles.garcons')
        ]);

        $this->deleteUsersJsonEndpoint($this->user, $this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');

        $this->assertDatabaseHas('users', $this->user->toArray());
    }

    /**
     *  Test if authenticated users with the admin role can delete users
     */
    public function test_authenticated_users_with_the_admin_role_can_delete_users()
    {

        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->signInAndSetToken(null, [
           'role' => config('acl.roles.admin')
        ]);

        $this->deleteUsersJsonEndpoint($this->user, $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee('message')
            ->assertJsonFragment([
                'message' => __('Acl::responses.user-deleted')
            ]);

        $this->assertDatabaseMissing('users', $this->user->toArray());
    }

    /**
     * @param User $user
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function deleteUsersJsonEndpoint(User $user, $headers = [])
    {
        return $this->deleteJson($user->path('delete'), [], $headers);
    }
}
