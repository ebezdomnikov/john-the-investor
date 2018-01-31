<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $possibleStocks = ['Common stock' => 'common', 'Preferred stock' => 'preferred'];

        foreach ($possibleStocks as $name => $type) {
            factory(App\Stock::class)->create([
                'name' => $name,
                'type' => $type,
            ]);
        }

        $possibleCompanyNames = ['kiveo AG', 'Metadeo AG'];
        foreach ($possibleCompanyNames as $companyName) {
            factory(App\Company::class)->create(['name' => $companyName])->each(function ($company) {
                $stocks = App\Stock::get();
                foreach ($stocks as $stock) {
                    factory(App\CompanyStock::class)->create([
                        'company_id' => $company->id,
                        'stock_id' => $stock->id
                    ]);
                }
            });
        }

        $possibleMarketNames = ['New York Stock Exchange', 'London Stock Exchange',
            'Hong Kong Stock Exchange', 'Shanghai Stock Exchange', 'Deutsche Börse Frankfurt'
        ];

        foreach ($possibleMarketNames as $marketName) {
            factory(App\Market::class)->create(['name' => $marketName]);
        }

        factory(App\MarketPrice::class, 10)->create();
    }
}
