<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchStockRequest;
use App\Repositories\StockRepository;
use App\Services\ShowCompanyProfileService;
use Illuminate\View\View;

class CompaniesController extends Controller
{
    private StockRepository $repository;
    private ShowCompanyProfileService $companyProfileService;

    public function __construct(StockRepository $repository, ShowCompanyProfileService $companyProfileService)
    {
        $this->repository = $repository;
        $this->companyProfileService = $companyProfileService;
    }

    public function index(SearchStockRequest $request): View
    {
        $stocksCollection = $this->repository->searchCompanies($request->get("search"))->getStocksCollection();
        return view("search.results", ["stocks" => $stocksCollection]);
    }

    public function show($id): View
    {
        return $this->companyProfileService->execute($id);
    }
}
