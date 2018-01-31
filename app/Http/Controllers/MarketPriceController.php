<?php

namespace App\Http\Controllers;

use App\CompanyStock;
use App\Market;
use App\MarketPrice;
use App\Stock;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class MarketPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = MarketPrice::with('market')
            ->with('companyStock.stock')
            ->with('companyStock.company')
            ->paginate();

        return view('prices/index')
            ->withPrices($prices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companiesStocks = CompanyStock::with('stock', 'company')->get();
        $markets = Market::get();

        return view('prices/create')->with([
            'companiesStocks' => $companiesStocks,
            'markets'=> $markets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $companiesStockIds = CompanyStock::select('id')->get()->pluck('id')->toArray();
        $marketsIds = Market::select('id')->get()->pluck('id')->toArray();

        $this->validate($request, [
            'companyStock' => [
                'required',
                new In($companiesStockIds),
            ],
            'market' => [
                'required',
                new In($marketsIds)
            ],
            'price' => [
                'required',
                'regex:/^[0-9]*(\.?|\,?)[0-9]+$/'
            ]
        ]);

        $price = $request->get('price');
        $price = str_replace(',', '.', $price);

        try {
            $marketPrice = new MarketPrice();
            $marketPrice->market_id = $request->get('market');
            $marketPrice->company_stock_id = $request->get('companyStock');
            $marketPrice->value = round((float)$price * 100);
            $marketPrice->save();

        } catch (\Throwable $e) {
            return redirect(route('prices.create'))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error.'
                ]);
        }

        return redirect(route('prices.index'))->with([
            'level' => 'info',
            'message' => 'Company has been created'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $priceId
     * @return \Illuminate\Http\Response
     */
    public function edit($priceId)
    {
        $priceMarket = MarketPrice::with('market')
            ->with('companyStock')
            ->find($priceId);

        if ($priceMarket === null) {
            return redirect(route('prices.index'))->with([
                'level' => 'error',
                'message' => 'Market price with given id does\'t exists'
            ]);
        }

        $companiesStocks = CompanyStock::with('stock', 'company')->get();
        $markets = Market::get();

        return view('prices/edit')->with([
            'priceMarket' => $priceMarket,
            'companiesStocks' => $companiesStocks,
            'markets'=> $markets
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $priceId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $priceId)
    {
        $marketPrice = MarketPrice::find($priceId);

        if ($marketPrice ===  null) {
            return redirect(route('prices.index'))->with([
                'level' => 'error',
                'message' => 'Market price with given id does\'t exists'
            ]);
        }

        $companiesStockIds = CompanyStock::select('id')->get()->pluck('id')->toArray();
        $marketsIds = Market::select('id')->get()->pluck('id')->toArray();

        $this->validate($request, [
            'companyStock' => [
                'required',
                new In($companiesStockIds),
            ],
            'market' => [
                'required',
                new In($marketsIds)
            ],
            'price' => [
                'required',
                'regex:/^[0-9]*(\.?|\,?)[0-9]+$/'
            ]
        ]);

        $price = $request->get('price');
        $price = str_replace(',', '.', $price);

        try {

            $marketPrice->market_id = $request->get('market');
            $marketPrice->company_stock_id = $request->get('companyStock');
            $marketPrice->value = round((float)$price * 100);
            $marketPrice->save();

        } catch (\Throwable $e) {
            return redirect(route('prices.create'))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error.'
                ]);
        }

        return redirect(route('prices.index'))->with([
            'level' => 'info',
            'message' => 'Company has been created'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $priceId
     * @return \Illuminate\Http\Response
     */
    public function destroy($priceId)
    {
        $marketPrice = MarketPrice::find($priceId);

        if ($marketPrice === null) {
            return redirect(route('prices.index'))->with([
                'level' => 'error',
                'message' => 'Market price with given id does\'t exists'
            ]);
        }
        try {
            $marketPrice->delete();
        } catch (\Throwable $e) {
            return redirect(route('prices.index', ['id' => $marketPrice]))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error:' . $e->getMessage()
                ]);
        }

        return redirect(route('prices.index'))->with([
            'level' => 'info',
            'message' => 'Market price has been deleted'
        ]);
    }
}
