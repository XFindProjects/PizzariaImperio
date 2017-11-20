<?php
/**
 * Copyright (c) XFind - 2017. Todos os direitos reservados.
 * Criado por: Reginaldo Junior
 * Email: reginaldo.junior696@gmail.com
 * Data: 19/11/2017
 * Hora: 22:24:28
 */

use Faker\Generator as Faker;

$factory->define(\Ingredients\Models\Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->ingredient
    ];
});
