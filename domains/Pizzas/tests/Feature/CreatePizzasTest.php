<?php

namespace Pizzas\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreatePizzasTest extends TestCase
{
    use DatabaseMigrations;

    public function test_basic()
    {
        $this->assertTrue(true);
    }
}