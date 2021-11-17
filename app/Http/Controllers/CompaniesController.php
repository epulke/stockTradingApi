<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyStockRequest;
use App\Http\Requests\SearchStockRequest;
use App\Models\UserStock;
use App\Models\UserTransaction;
use App\Repositories\FinnhubModelRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(SearchStockRequest $request)
    {
        $stocksCollection = $this->repository->searchCompanies($request->get("search"))->getStocksCollection();
        return view("search.results", ["stocks" => $stocksCollection]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(BuyStockRequest $request)
    {
        $userStock = new UserStock ([
            "stock_symbol" => $request->get("symbol"),
            "purchase_price" => $request->get("quote"),
            "amount" => $request->get("amount")
        ]);
        $userStock->user()->associate(auth()->user());
        $userStock->save();

        $userTransaction = new UserTransaction([
            "transaction_type" => "buy",
            "stock_symbol" => $request->get("symbol"),
            "amount" => $request->get("amount"),
            "stock_price" => $request->get("quote")
        ]);
        $userTransaction->user()->associate(auth()->user());
        $userTransaction->save();

        return redirect()->route("portfolio");
    }

    public function show($id)
    {
        $companyProfile = $this->repository->getCompanyProfile($id);
        $quote = $this->repository->getStockQuote($id);
        return view("company.show", [
            "company" => $companyProfile,
            "quote" => $quote->quote
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
