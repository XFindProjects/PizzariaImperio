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
    $options = collect([]);

    $pizza = factory(\Pizzas\Models\Pizza::class)
        ->create();

    $options->push([
        'id' => $pizza->id,
        'type' => $pizza->getMorphClass()
    ]);

    $item = $faker->randomElement($options->toArray());
    return [
        'order_id' => function() {
            return factory(\Order\Models\Order::class)->create()->id;
        },
        'orderable_id' => $item['id'],
        'orderable_type' => $item['type'],
        'paid' => false,
        'price' => $faker->randomFloat(2, 40, 60)
    ];
});
