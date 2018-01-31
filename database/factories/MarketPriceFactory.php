<?php

use Faker\Generator as Faker;

$factory->define(App\MarketPrice::class, function (Faker $faker) {
    $market = array_first($faker->randomElements(\App\Market::select('id')->get()->toArray()));
    $company = array_first($faker->randomElements(\App\Company::select('id')->get()->toArray()));
    $company_stock = array_first($faker->randomElements(\App\CompanyStock::where('company_id', $company['id'])->select('id')->get()->toArray()));
    return [
        'market_id' => $market['id'],
        'company_stock_id' => $company_stock['id'],
        'value' => $faker->numberBetween(100,100000)
    ];
});
