<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 20/11/2017
 * Hora: 1:3:8
 */

use Faker\Generator as Faker;

$factory->define(\Order\Models\OrderItemObservation::class, function (Faker $faker) {
    return [
        'observation_type' => $faker->randomElement(config('orders.observation-types')),
        'observation_content' => $faker->sentence()
    ];
});
