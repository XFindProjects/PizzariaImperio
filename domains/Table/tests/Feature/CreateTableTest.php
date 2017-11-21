<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:48:26
 */

namespace Size\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Pizzaria\User;
use Table\Models\Table;
use Tests\TestCase;

class CreateTableTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test if unauthenticated users are blocked from access  the create table endpoin
     */
    public function test_unauthenticated_users_cannot_hit_the_create_table_endpoint()
    {
        $this->postJsonEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    /**
     * Test if authenticated users with a role witch is not admin cannot create tables
     */
    public function test_authenticated_users_with_the_wrong_role_cannot_create_tables()
    {
        $this->signInAndSetToken(create(User::class, [
            'role' => config('acl.roles.garcons')
        ]));

        $this->postJsonEndpoint([], $this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');

        $this->assertCount(0, Table::all());
    }

    /**
     *  Test if authenticated admin's can create new tables
     */
    public function test_authenticated_users_with_the_admin_role_can_create_tables()
    {
        $this->signInAndSetToken(create(User::class, [
            'role' => config('acl.roles.admin')
        ]));

        $this->postJsonEndpoint([], $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee('id');

        $this->assertCount(1, Table::all());
    }

    /**
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function postJsonEndpoint($data = [], $headers = [])
    {
        return $this->postJson(Table::createPath(), $data, $headers);
    }
}