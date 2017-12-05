<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 26/11/2017
 * Hora: 16:14:9
 */

namespace Size\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Size\Models\Size;
use Tests\TestCase;

class DeleteSizeTest extends TestCase
{
    use DatabaseMigrations;

    private $size;

    protected function setUp()
    {
        parent::setUp();
        $this->size = Size::generate();
    }

    public function test_unauthenticated_users_cannot_hit_the_delete_size_endpoint()
    {
        $this->deletePathJsonEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    public function test_unauthorized_users_cannot_delete_sizes()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $this->deletePathJsonEndpoint($this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id
        ]);
    }

    public function test_authorized_users_can_delete_sizes()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $this->deletePathJsonEndpoint($this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee(__('Size::responses.size-deleted'));

        $this->assertSoftDeleted('sizes', [
            'id' => $this->size->id
        ]);
    }

    /**
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function deletePathJsonEndpoint($headers = [])
    {
        return $this->deleteJson($this->size->path('delete'), [], $headers);
    }
}