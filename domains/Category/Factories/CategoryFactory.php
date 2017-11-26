<?php

use Faker\Generator as Faker;

$factory->define(\Category\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Pizza', 'Porção', 'Bebida'])
    ];
});
