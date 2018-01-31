<?php

use Faker\Generator as Faker;

$factory->define(App\Stock::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
