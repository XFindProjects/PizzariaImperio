<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 21/11/2017
 * Hora: 10:24:15
 */

namespace Category\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
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