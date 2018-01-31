<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('stocks')
            ->with('markets.market')
            ->paginate();

        return view('company/index')
            ->withCompanies($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stockTypes = Stock::get();

        return view('company/create')->with([
            'stockTypes' => $stockTypes
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
        $stockIds = Stock::select('id')->get()->pluck('id')->toArray();
        $this->validate($request, [
            'name' => 'required|max:150|regex:/^[0-9A-Za-z\.\,\-_\s\[\]\(\)]+$/',
            'stock.*' => new In($stockIds)
        ]);

        try {
            $company = new Company();

            $company->getConnection()->transaction(function () use ($company, $request) {
                $company->name = $request->get('name');
                $company->save();

                if ($request->has('stock')) {
                    $stocks = $request->get('stock');
                    foreach ($stocks as $stock) {
                        $company->stocks()->attach($stock);
                    }
                }
            });
        } catch (\Throwable $e) {
            return redirect(route('companies.create'))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error.'
                ]);
        }

        return redirect(route('companies.index'))->with([
            'level' => 'info',
            'message' => 'Company has been created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($companyId)
    {
        $stockTypes = Stock::get();

        $company = Company::with('stocks')->find($companyId);

        if ($company === null) {
            return redirect(route('companies.index'))->with([
                'level' => 'error',
                'message' => 'Company with given id does\'t exists'
            ]);
        }

        return view('company/edit')->with([
            'company' => $company,
            'stockTypes' => $stockTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $companyId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyId)
    {
        $company = Company::with('stocks')->find($companyId);

        if ($company === null) {
            return redirect(route('companies.index'))->with([
                'level' => 'error',
                'message' => 'Company with given id does\'t exists'
            ]);
        }

        $stockIds = Stock::select('id')->get()->pluck('id')->toArray();

        $this->validate($request, [
            'name' => 'max:150|regex:/^[0-9A-Za-z\.\,\-_\s\[\]\(\)]+$/',
            'stock.*' => new In($stockIds)
        ]);

        try {

            $company->getConnection()->transaction(function () use ($company, $request) {

                if ($request->has('name')) {
                    $company->name = $request->get('name');
                    $company->save();
                }

                if ($request->has('stock')) {
                    $stocks = $request->get('stock');
                    $company->stocks()->sync($stocks);
                } else {
                    $company->stocks()->toggle($company->stocks);
                }
            });
        } catch (\Throwable $e) {
            return redirect(route('companies.edit', ['id' => $companyId]))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error:' . $e->getMessage()
                ]);
        }

        return redirect(route('companies.index'))->with([
            'level' => 'info',
            'message' => 'Company has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $companyId
     * @return \Illuminate\Http\Response
     */
    public function destroy($companyId)
    {
        $company = Company::find($companyId);

        if ($company === null) {
            return redirect(route('companies.index'))->with([
                'level' => 'error',
                'message' => 'Company with given id does\'t exists'
            ]);
        }
        try {
            $company->delete();
        } catch (\Throwable $e) {
            return redirect(route('companies.index', ['id' => $companyId]))
                ->with([
                    'level' => 'error',
                    'message' => 'Database save error:' . $e->getMessage()
                ]);
        }

        return redirect(route('companies.index'))->with([
            'level' => 'info',
            'message' => 'Company has been deleted'
        ]);
    }
}
