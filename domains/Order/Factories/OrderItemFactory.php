<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 0:38:43
 */

use Faker\Generator as Faker;

$factory->define(\Order\Models\OrderItem::class, function (Faker $faker) {
    $category = function () {
        return \Category\Models\Category::first();
    };
    return [
        'order_id' => function () {
            return factory(\Order\Models\Order::class)->create()->id;
        },
        'category_id' => function () use ($category) {
            return $category()->id;
        },
        'size_id' => function () use ($category) {
            return $category()->sizes()->get()->random()->id;
        },
        'paid' => false
    ];
});
