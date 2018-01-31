<?php

use Faker\Generator as Faker;

$factory->define(App\CompanyStock::class, function (Faker $faker) {
    return [
        'company_id' => $faker->numberBetween(1,1),
        'stock_id' => $faker->numberBetween(1,1),
    ];
});
