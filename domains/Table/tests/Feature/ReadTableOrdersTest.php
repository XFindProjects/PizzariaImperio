<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 11:56:17
 */

namespace Size\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Order\Models\Order;
use Pizzaria\User;
use Table\Models\Table;
use Tests\TestCase;

class ReadTableOrdersTest extends TestCase
{
    use DatabaseMigrations;

    private $table;

    protected function setUp()
    {
        parent::setUp();
        $this->table = Table::generate();
    }

    public function test_if_unauthenticated_users_cannot_hit_the_read_table_orders_endpoint()
    {
        $table = $this->table;

        $this->readTableOrdersJsonEndpoint($table)
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_if_authenticated_users_with_the_wrong_role_cannot_read_table_orders()
    {
        $table = $this->table;
        $order = Order::generate([
            'table_id' => $table->id
        ]);
        $this->signInAndSetToken(null, [
           'role' => config('acl.roles.garcons')
        ]);

        $this->readTableOrdersJsonEndpoint($table, $this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertDontSee("{$order->created_at}");
    }

    public function test_if_authenticated_users_with_admin_role_can_read_table_orders()
    {
        $table = $this->table;
        $order = Order::generate([
            'table_id' => $table->id
        ]);
        $this->signInAndSetToken(null, [
           'role' => config('acl.roles.admin')
        ]);

        $this->readTableOrdersJsonEndpoint($table, $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertJsonStructure($this->generatePaginationJsonStructure());
    }

    private function readTableOrdersJsonEndpoint(Table $table, $headers = [])
    {
        return $this->getJson($table->read_orders_path, $headers);
    }
}