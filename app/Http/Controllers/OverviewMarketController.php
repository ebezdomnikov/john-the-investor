<?php

namespace App\Http\Controllers;

use App\Market;

class OverviewMarketController extends Controller
{
    public function index()
    {
        $markets = Market::with('prices.companyStock.company', 'prices.companyStock.stock')->get();

        return view('overview/market')->withMarkets($markets);
    }
}
