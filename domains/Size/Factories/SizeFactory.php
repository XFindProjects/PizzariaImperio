<?php

use Faker\Generator as Faker;

$factory->define(\Size\Models\Size::class, function (Faker $faker) {
    $sizeable = create(\Category\Models\Category::class);
    return [
        'name' => $faker->sentence,
        'sizeable_type' => $sizeable->getMorphClass(),
        'sizeable_id' => $sizeable->getKey(),
        'price' => $faker->randomFloat(2, 20, 60)
    ];
});
