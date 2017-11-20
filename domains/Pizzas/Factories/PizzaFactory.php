<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 22:24:40
 */

use Faker\Generator as Faker;

$factory->define(Pizzas\Models\Pizza::class, function (Faker $faker) {
    return [
        'flavor' => $faker->slavor,
        'image' => basename($faker->image(public_path('storage/images'), 640, 480, 'food')),
        'description' => $faker->sentence(10)
    ];
});
