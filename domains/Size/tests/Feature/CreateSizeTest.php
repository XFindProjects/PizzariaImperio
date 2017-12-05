<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:25:39
 */

namespace Size\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Size\Models\Size;
use Tests\TestCase;

class CreateSizeTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var
     */
    private $attributes;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->attributes = Size::fake()->toArray();
    }

    /**
     *  Test if unauthenticated users can't even touch the create size endpoint
     */
    public function test_unauthenticated_users_cannot_hit_the_create_size_endpoint()
    {
        $this->createPathJsonEndpoint()
            ->assertStatus(401)
            ->assertSee('Unauthenticated');
    }

    /**
     *  Test if authenticated users witch are not admin cannot create sizes
     */
    public function test_authenticated_users_with_the_wrong_role_cannot_create_sizes()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.garcons')
        ]);
        $this->createPathJsonEndpoint([], $this->generateAuthHeaders())
            ->assertStatus(403)
            ->assertSee('Unauthorized');
    }

    /**
     *  Test if authenticated admins can create sizes
     */
    public function test_authenticated_users_with_the_admin_role_can_create_sizes()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $this->createPathJsonEndpoint($this->attributes, $this->generateAuthHeaders())
            ->assertStatus(200)
            ->assertSee("{$this->attributes['price']}");

        $this->assertDatabaseHas('sizes', $this->attributes);
    }

    /**
     *  Test creation validation
     */
    public function test_all_fields_required_are_passed_on_request()
    {
        $this->signInAndSetToken(null, [
            'role' => config('acl.roles.admin')
        ]);

        $test = function ($attributes) {
            $this->createPathJsonEndpoint($attributes, $this->generateAuthHeaders())
                ->assertStatus(422)
                ->assertJsonStructure([
                    "message",
                    "errors" => collect($this->attributes)
                        ->filter(function ($value, $attr) use ($attributes) {
                            return !collect($attributes)->has($attr);
                        })
                        ->keys()
                        ->toArray()
                ]);
        };

        $attributes = [
            'name' => $this->attributes['name']
        ];

        //  Send a post request only with name
        $test($attributes);


        $attributes["sizeable_id"] = $this->attributes['sizeable_id'];
        $attributes["sizeable_type"] = $this->attributes['sizeable_type'];
        //  Send a post request with name and email
        $test($attributes);

        $attributes['price'] = $this->attributes['price'];
        //  Send a post request with all the fields

        $this->createPathJsonEndpoint($attributes, $this->generateAuthHeaders())
            //  Assert status is a ok response
            ->assertStatus(200)
            //  Assert the response body contains the user data
            ->assertSee("{$this->attributes['price']}")
            //  Assert we don't have a unauthorized error
            ->assertDontSee('Unauthorized');

        //  Check if user was not added to the database
        $this->assertDatabaseHas('sizes', ['price' => $this->attributes['price']]);
    }


    /**
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createPathJsonEndpoint($data = [], $headers = [])
    {
        return $this->postJson(Size::getPath('create'), $data, $headers);
    }
}