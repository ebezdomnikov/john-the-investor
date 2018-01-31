<?php

namespace App\Http\Controllers;

use App\MarketPrice;
use App\CompanyStock;

class OverviewCompanyController extends Controller
{
    public function index()
    {
        $stocks = CompanyStock::with('stock', 'company')
            ->with('prices.market')
            ->orderBy('company_id', 'desc')
            ->orderBy('stock_id', 'desc')
            ->get();

        $sums = MarketPrice::with('companyStock', 'market')
            ->whereHas('companyStock')
            ->select(\DB::raw('sum(value) as marketSum, company_stock_id, market_id'))
            ->groupBy(['company_stock_id', 'market_id'])
            ->get()
            ->groupBy('company_stock_id');

        $stocks = $stocks->map(function($stock) use($sums) {
            return [
                'stock' => $stock,
                'markets' => $sums[$stock->id]??[]
            ];
        });

        return view('overview/company')->withStocks($stocks);
    }
}
