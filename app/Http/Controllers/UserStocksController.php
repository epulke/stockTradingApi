<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyStockRequest;
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

    public function __construct(
        StockRepository $repository,
        BuyStockService $buyStockService,
        SellStockService $sellStockService,
        GetUserPortfolioService $getUserPortfolioService,
        PaginationHelpService $paginationHelpService
    )
    {
        $this->repository = $repository;
        $this->buyStockService = $buyStockService;
        $this->sellStockService = $sellStockService;
        $this->getUserPortfolioService = $getUserPortfolioService;
        $this->paginationHelpService = $paginationHelpService;
    }

    public function index(): View
    {
        $portfolio = ($this->getUserPortfolioService->execute());
        $portfolioPaginated = $this->paginationHelpService->paginate($portfolio, 10);

        return view("portfolio", ["portfolio" => $portfolioPaginated]);
    }

    public function buyStock(BuyStockRequest $request, string $symbol): RedirectResponse
    {
//        echo "<pre>";
//        var_dump($request->path());die;
        $amount = $request->get("amountBuy");
        // TODO pielikt validator, ka nevar nopirkt, ja nepietiek funds

        $this->buyStockService->execute($amount, $symbol);

        return redirect()->route("portfolio.index");
    }

    public function sellStock(SellStockRequest $request, $symbol): RedirectResponse
    {
        // TODO šeit jāvalidē, ka nevar pārdot vairāk nekā viņam ir
        $amount = $request->get("amountSell");
        $this->sellStockService->execute($amount, $symbol);

        return redirect()->route("portfolio.index");
    }

    public function test()
    {
        return view("test");
    }
}
