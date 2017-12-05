<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 26/11/2017
 * Hora: 15:51:7
 */

namespace Size\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Size\Models\Size;
use Tests\TestCase;

class ReadSizeTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_users_cannot_hit_the_read_sizes_endpoint()
    {
        $this->readPathJsonEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_authenticated_users_can_read_sizes()
    {
        $size = Size::generate();

        $this->signInAndSetToken(null, [
           'role' => config('acl.roles.garcons')
        ]);

        $this->readPathJsonEndpoint($this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee("{$size->price}");
    }


    /**
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function readPathJsonEndpoint($headers = [])
    {
        return $this->getJson(Size::getPath('read'), $headers);
    }
}