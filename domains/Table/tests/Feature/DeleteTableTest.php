<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 11:56:3
 */

namespace Size\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Pizzaria\User;
use Table\Models\Table;
use Tests\TestCase;

class DeleteTableTest extends TestCase
{
    use DatabaseMigrations;

    private $table;

    protected function setUp()
    {
        parent::setUp();
        $this->table = Table::generate();
    }

    public function test_if_unauthenticated_users_cannot_hit_the_delete_table_endpoint()
    {
        $this->deleteTableJsonEndpoint($this->table)
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_if_authenticated_users_with_the_wrong_role_cannot_delete_table()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $this->deleteTableJsonEndpoint($this->table, $this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');

        $this->assertDatabaseHas('tables', $this->table->toArray());
    }

    public function test_if_authenticated_users_with_the_admin_role_can_delete_table()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $this->assertDatabaseHas('tables', [
            'id' => $this->table->id
        ]);

        $this->deleteTableJsonEndpoint($this->table, $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee('message')
            ->assertJsonFragment([
                'message' => __('Table::responses.table-deleted')
            ]);

        $this->assertSoftDeleted('tables', [
            'id' => $this->table->id
        ]);

    }

    private function deleteTableJsonEndpoint(Table $table, $headers = [])
    {
        return $this->deleteJson($table->deletePath(), [], $headers);
    }
}