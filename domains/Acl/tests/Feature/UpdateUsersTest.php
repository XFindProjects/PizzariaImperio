<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 23:33:33
 */

namespace Acl\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Pizzaria\User;
use Tests\TestCase;

class UpdateUsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var
     */
    protected $user;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        $this->user = User::generate();
    }

    /**
     *  Check if unauthenticated users cannot update users
     */
    public function test_unauthenticated_users_cannot_update_users()
    {
        //  Given we don't have signed in user
        $attributes = [
            'name' => 'Jhon Thyson'
        ];
        //  When it tries to hit the update endpoint
        $this->patchJson($this->user->update_path, $attributes, $this->generateAuthHeaders())
            //  It should see a response code of 401
            ->assertStatus(401)
            //  Witch means "Unauthenticated action"
            ->assertSee('Unauthenticated');

        //  And the record should not update at all
        $this->assertDatabaseMissing('users', $attributes);
    }

    /**
     *  Check if unauthorized users cannot update users
     */
    public function test_unauthorized_users_cannot_update_users()
    {
        //  Given we have a signed in user with the role of garcom
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        $attributes = [
            'name' => 'Jhon Thyson'
        ];
        //  When it tries to hit the update endpoint
        $this->patchJson($this->user->update_path, $attributes, $this->generateAuthHeaders())
            //  It should see a response code of 403
            ->assertStatus(403)
            //  Witch means "Unauthorized action"
            ->assertSee('Unauthorized');

        //  And the record should not be updated at all
        $this->assertDatabaseMissing('users', $attributes);
    }

    /**
     *
     */
    public function test_user_needs_name_email_and_role_to_be_updated()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);
        $attributes = [];

        //  Check if has error wen no name and email and role supplied
        $this->patchJson($this->user->update_path, $attributes, $this->generateAuthHeaders())
            ->assertSee('name')
            ->assertSee('role')
            ->assertSee('email');

        $attributes = [
            'name' => 'Jhon Thyson'
        ];
        //  Check if has error wen no email and role supplied
        $this->patchJson($this->user->update_path, $attributes, $this->generateAuthHeaders())
            ->assertSee('email')
            ->assertSee('role');

        $attributes['email'] = $this->user->email;
        //  Check if has error wen no role supplied
        $this->patchJson($this->user->update_path, $attributes, $this->generateAuthHeaders())
            ->assertSee('role');

        $attributes['role'] = $this->user->role;
        $this->patchJson($this->user->update_path, $attributes, $this->generateAuthHeaders())
            ->assertStatus(200);
    }

    /**
     *  Check if authorized users can update users
     */
    public function test_authorized_users_can_update_users()
    {
        //  Given we have a admin user
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $attributes = [
            'name' => 'Jhon Thyson',
            'email' => $this->user->email,
            'role' => $this->user->role
        ];
        //  When it tries to hit the update endpoint
        $this->patchJson($this->user->update_path, $attributes, $this->generateAuthHeaders())
        ->assertStatus(200)
        ->assertSee($attributes['name']);


        //  And the record should be updated
        $this->assertDatabaseHas('users', $attributes);
    }
}
