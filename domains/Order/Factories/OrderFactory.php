<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 0:38:37
 */

use Faker\Generator as Faker;

$factory->define(\Order\Models\Order::class, function (Faker $faker) {
    return [
        'table_id' => function() {
            return factory(\Table\Models\Table::class)->create()->id;
        },
        'observations' => $faker->sentence(),
        'closed' => false
    ];
});
