<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchStockRequest;
use App\Repositories\FinnhubModelRepository;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    private FinnhubModelRepository $finnhub;

    public function __construct(FinnhubModelRepository $finnhub)
    {
        $this->finnhub = $finnhub;
    }

    public function index(SearchStockRequest $request)
    {
        $stocksCollection = $this->finnhub->getStock($request->get("search"))->getStocksCollection();
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
