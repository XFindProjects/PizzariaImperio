<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test if user is correctly created
     *
     * @return void
     */
    public function test_user_can_be_created()
    {
        $attributes = [
            'name' => 'Jhon Doe',
            'email' => 'jhondoe@mail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'role' => 1
        ];

        $this->post(route('Acl::create-users.store'), $attributes)
            ->assertStatus(200)
            ->assertSee($attributes['email']);
    }
}
