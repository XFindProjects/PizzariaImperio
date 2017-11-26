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

class CreateUsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var
     */
    protected $attributes;

    /**
     *  Setup the tests
     */
    protected function setUp()
    {
        parent::setUp();
        $this->attributes = [
            'name' => 'Jhon Doe',
            'email' => 'jhondoe@mail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'role' => 1
        ];
    }

    /**
     * Test if user is correctly created
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_create_users()
    {
        //  Given we don't have a signed in user
        //  Then the api should return Unauthenticated error

        //  Send a post request
        $this->createUserJsonEndpoint($this->attributes)
            //  Check if response status is ok
            ->assertStatus(401)
            //  Check if response body contains the string "Unauthenticated"
            ->assertSee('Unauthenticated')
            //  Check if response body don't contains user email
            ->assertDontSee($this->attributes['email']);

        //  Check if user was stored correctly on database
        $this->assertDatabaseMissing('users', ['email' => $this->attributes['email']]);
    }

    /**
     *  Test if authenticated user with wrong role is blocked by the api
     *
     * @return void
     */
    public function test_authenticated_users_with_the_wrong_role_cannot_create_users()
    {
        //  Given we have a signed in user with a role witch is not the admin role
        //  Then the api should return an Authorization error

        //  Here we sign in the user with the role of "garçom"
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);

        //  Send a post request
        $this->createUserJsonEndpoint($this->attributes, $this->generateAuthHeaders())
            //  Check if status is an Authorization error code
            ->assertStatus(403)
            //  Check if the response body has unauthorized message
            ->assertSee('Unauthorized')
            //  Check if we don't send together the email address from the user witch would be created
            ->assertDontSee($this->attributes['email']);

        //  Check if user was not added to the database
        $this->assertDatabaseMissing('users', ['email' => $this->attributes['email']]);
    }

    /**
     *  Test is admin users can create users
     *
     * @return void
     */
    public function test_authenticated_users_with_the_admin_role_can_create_users()
    {
        //  Given we have a signed in user with the admin role
        //  Then the api should create the user and return the json data

        //  Here we sign in the user with the admin role
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        //  Send a post request
        $this->createUserJsonEndpoint($this->attributes, $this->generateAuthHeaders())
            //  Assert status is a ok response
            ->assertStatus(200)
            //  Assert the response body contains the user data
            ->assertSee($this->attributes['email'])
            //  Assert we don't have a unauthorized error
            ->assertDontSee('Unauthorized');

        //  Check if user was not added to the database
        $this->assertDatabaseHas('users', ['email' => $this->attributes['email']]);
    }

    /**
     *  Test is validation is working
     *
     * @return void
     */
    public function test_authenticated_users_with_the_admin_role_can_create_users_with_the_right_attributes()
    {
        //  Given we have a signed in user with the admin role
        //  Then the api should create the user and return the json data

        //  Here we sign in the user with the admin role
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $test = function ($attributes) {
            $this->createUserJsonEndpoint($attributes, $this->generateAuthHeaders())
                ->assertStatus(422)
                ->assertJsonStructure([
                    "message",
                    "errors" => collect($this->attributes)
                        ->flip()
                        ->filter(function ($attr) use ($attributes) {
                            return !collect($attributes)->has($attr) &&
                                $attr != 'password_confirmation';
                        })
                        ->values()
                        ->toArray()
                ]);
        };

        $attributes = [
            'name' => $this->attributes['name']
        ];

        //  Send a post request only with name
        $test($attributes);


        $attributes["email"] = $this->attributes['email'];
        //  Send a post request with name and email
        $test($attributes);

        $attributes['password'] = $this->attributes['password'];
        $attributes['password_confirmation'] = $this->attributes['password_confirmation'];
        //  Send a post request with name,email,password,password_confirmation fields
        $test($attributes);

        $attributes['role'] = $this->attributes['role'];
        $this->createUserJsonEndpoint($attributes, $this->generateAuthHeaders())
            //  Assert status is a ok response
            ->assertStatus(200)
            //  Assert the response body contains the user data
            ->assertSee($this->attributes['email'])
            //  Assert we don't have a unauthorized error
            ->assertDontSee('Unauthorized');

        //  Check if user was not added to the database
        $this->assertDatabaseHas('users', ['email' => $this->attributes['email']]);
    }


    /**
     * @param null $attributes
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createUserJsonEndpoint($attributes = null, $headers = [])
    {
        //  Json request to create users
        return $this->postJson(User::createPath(), $attributes, $headers);
    }
}
