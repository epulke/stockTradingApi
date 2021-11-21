<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyStockRequest;
use App\Http\Requests\PortfolioFilterRequest;
use App\Http\Requests\SellStockRequest;
use App\Models\Collections\UserPortfolioEntryCollection;
use App\Models\User;
use App\Models\UserFunds;
use App\Models\UserPortfolioEntry;
use App\Models\UserStock;
use App\Models\UserTransaction;
use App\Repositories\StockRepository;
use App\Rules\EnoughFunds;
use App\Services\BuyStockService;
use App\Services\FilterPortfolioService;
use App\Services\GetUserPortfolioService;
use App\Services\PaginationHelpService;
use App\Services\SellStockService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserStocksController extends Controller
{
    private StockRepository $repository;
    private BuyStockService $buyStockService;
    private SellStockService $sellStockService;
    private GetUserPortfolioService $getUserPortfolioService;
    private PaginationHelpService $paginationHelpService;
    private FilterPortfolioService $filterPortfolioService;

    public function __construct(
        StockRepository $repository,
        BuyStockService $buyStockService,
        SellStockService $sellStockService,
        GetUserPortfolioService $getUserPortfolioService,
        PaginationHelpService $paginationHelpService,
        FilterPortfolioService $filterPortfolioService
    )
    {
        $this->repository = $repository;
        $this->buyStockService = $buyStockService;
        $this->sellStockService = $sellStockService;
        $this->getUserPortfolioService = $getUserPortfolioService;
        $this->paginationHelpService = $paginationHelpService;
        $this->filterPortfolioService = $filterPortfolioService;
    }

    public function index(): View
    {
        $portfolio = ($this->getUserPortfolioService->execute());
        $portfolioPaginated = $this->paginationHelpService->paginate($portfolio, 10);

        return view("portfolio", ["portfolio" => $portfolioPaginated]);
    }

    public function buyStock(BuyStockRequest $request, string $symbol): RedirectResponse
    {
        $amount = $request->get("amountBuy");
        $this->buyStockService->execute($amount, $symbol);

        return redirect()->route("portfolio.index");
    }

    public function sellStock(SellStockRequest $request, $symbol): RedirectResponse
    {
        $amount = $request->get("amountSell");
        $this->sellStockService->execute($amount, $symbol);

        return redirect()->route("portfolio.index");
    }

    public function filter(PortfolioFilterRequest $request): View
    {
        $position = $request->get("position");
        $type = $request->get("type");
        $portfolio = $this->filterPortfolioService->execute($position, $type);

        return view("portfolio", ["portfolio" => $portfolio]);
    }
}
