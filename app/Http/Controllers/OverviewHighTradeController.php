<?php

namespace App\Http\Controllers;

use App\MarketPrice;

class OverviewHighTradeController extends Controller
{
    public function index()
    {
        $highTrades = MarketPrice::select(\DB::raw('max(value) as highPrice, market_id, company_stock_id'))
            ->groupBy(['market_id'])
            ->with('companyStock.company', 'companyStock.stock', 'market')
            ->get();

        return view('overview/hightrade')->with([
            'highTrades' => $highTrades
        ]);
    }
}
