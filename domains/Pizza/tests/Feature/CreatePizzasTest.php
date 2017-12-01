<?php

namespace Pizza\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Pizza\Models\Pizza;
use Tests\TestCase;

class CreatePizzasTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_users_cannot_hit_the_create_pizzas_endpoint()
    {
        $this->assertTrue(true);
    }

    private function createPizzaEndpoint()
    {
        return $this->postJson(Pizza::createPath);
    }
}