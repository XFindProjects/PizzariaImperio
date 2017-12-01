<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 11:56:21
 */

namespace Size\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Pizzaria\User;
use Table\Models\Table;
use Tests\TestCase;

class ReadTableTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test if unauthenticated users cannot hit the read tables endpoint
     */
    public function test_unauthenticated_users_cannot_hit_the_read_tables_endpoint()
    {
        $this->readTableJsonEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    /**
     *  Test if authenticated users with any role can read tables
     */
    public function test_authenticated_users_can_read_tables()
    {
        $this->signInAndSetToken();

        $table = Table::generate();

        $this->readTableJsonEndpoint($this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertJsonStructure($this->generatePaginationJsonStructure());
    }

    /**
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function readTableJsonEndpoint($headers = [])
    {
        return $this->getJson(Table::readPath(), $headers);
    }
}