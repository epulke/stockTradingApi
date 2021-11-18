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
use App\Services\SellStockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserStocksController extends Controller
{
    private StockRepository $repository;
    private BuyStockService $buyStockService;
    private SellStockService $sellStockService;

    public function __construct(
        StockRepository $repository,
        BuyStockService $buyStockService,
        SellStockService $sellStockService
    )
    {
        $this->repository = $repository;
        $this->buyStockService = $buyStockService;
        $this->sellStockService = $sellStockService;
    }

    public function index()
    {
        $portfolio = new UserPortfolioEntryCollection();
        $stocks = auth()->user()->stocks()->get();

        foreach ($stocks as $stock)
        {
            $entry = new UserPortfolioEntry($stock, $this->repository->getStockQuote($stock->stock_symbol));
            $portfolio->add($entry);
        }

        return view("portfolio", ["portfolio" => $portfolio->getPortfolio()]);
    }

    public function buyStock(BuyStockRequest $request, string $symbol): RedirectResponse
    {
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
