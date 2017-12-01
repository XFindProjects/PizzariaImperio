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

class ReadUsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *  Test if unauthenticated users are bloqued from read another users
     */
    public function test_unauthenticated_users_cannot_read_other_users()
    {
        $user = User::generate();

        $this->getUsersJsonEndpoint($this->generateAuthHeaders())
            ->assertStatus(401)
            ->assertDontSee($user->slug);
    }

    /**
     *  Test if authenticated admin users can read another users
     */
    public function test_authenticated_users_with_the_admin_role_can_read_all_users()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $user = User::generate();

        $this->getUsersJsonEndpoint($this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee($user->slug)
            ->assertJsonStructure($this->generatePaginationJsonStructure());
    }

    /**
     *  Test if authenticated users with a role witch is not admin cannot read another users
     */
    public function test_authenticated_users_without_the_admin_cannot_read_users()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $this->getUsersJsonEndpoint($this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');
    }

    /**
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    protected function getUsersJsonEndpoint($headers = [])
    {
        return $this->getJson(User::readPath(), $headers);
    }
}
