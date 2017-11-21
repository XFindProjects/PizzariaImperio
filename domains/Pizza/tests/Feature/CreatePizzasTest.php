<?php

namespace Pizza\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreatePizzasTest extends TestCase
{
    use DatabaseMigrations;

    public function test_basic()
    {
        $this->assertTrue(true);

        //  orders
        //  orders has order_items
        //  order_items belongs to a category
        //  order_items has a size from the order_item category
        //  size has a price
        //  order_items->price = order_items->size->price
    }
}