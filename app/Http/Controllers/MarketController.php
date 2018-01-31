<?php

namespace App\Http\Controllers;

use App\Market;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markets = Market::paginate();

        return view('market/index')
            ->withMarkets($markets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('market/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150|regex:/^[0-9A-Za-z\.\,\-_\s\[\]\(\)]+$/',
        ]);

        try {
            $market = new Market();

            $market->name = $request->get('name');
            $market->save();

        } catch (\Throwable $e) {
            return redirect(route('markets.create'))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error.'
                ]);
        }

        return redirect(route('markets.index'))->with([
            'level' => 'info',
            'message' => 'Market has been created'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $marketId
     * @return \Illuminate\Http\Response
     */
    public function edit($marketId)
    {
        $market = Market::find($marketId);

        if ($market === null) {
            return redirect(route('markets.index'))->with([
                'level' => 'error',
                'message' => 'Market with given id does\'t exists'
            ]);
        }

        return view('market/edit')->with([
            'market' => $market,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $marketId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $marketId)
    {
        $market = Market::find($marketId);

        if ($market === null) {
            return redirect(route('markets.index'))->with([
                'level' => 'error',
                'message' => 'Market with given id does\'t exists'
            ]);
        }

        $this->validate($request, [
            'name' => 'max:150|regex:/^[0-9A-Za-z\.\,\-_\s\[\]\(\)]+$/',
        ]);

        try {
            if ($request->has('name')) {
                $market->name = $request->get('name');
                $market->save();
            }
        } catch (\Throwable $e) {
            return redirect(route('markets.edit', ['id' => $marketId]))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error:' . $e->getMessage()
                ]);
        }

        return redirect(route('markets.index'))->with([
            'level' => 'info',
            'message' => 'Market has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $marketId
     * @return \Illuminate\Http\Response
     */
    public function destroy($marketId)
    {
        $market = Market::find($marketId);

        if ($market === null) {
            return redirect(route('markets.index'))->with([
                'level' => 'error',
                'message' => 'Market with given id does\'t exists'
            ]);
        }
        try {
            $market->delete();
        } catch (\Throwable $e) {
            return redirect(route('markets.index', ['id' => $marketId]))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error:' . $e->getMessage()
                ]);
        }

        return redirect(route('markets.index'))->with([
            'level' => 'info',
            'message' => 'Market has been deleted'
        ]);
    }
}
