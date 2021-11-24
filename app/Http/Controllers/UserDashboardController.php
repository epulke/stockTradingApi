<?php

namespace App\Http\Controllers;

use App\Models\UserFunds;
use App\Models\UserStock;
use App\Services\GetPortfolioCurrentValueService;
use App\Services\GetProfitLossService;
use App\Services\GetStocksProportionService;
use App\Services\GetUserPortfolioService;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    private GetUserPortfolioService $getUserPortfolioService;
    private GetPortfolioCurrentValueService $getPortfolioCurrentValueService;
    private GetStocksProportionService $getStocksProportionService;
    private GetProfitLossService $getProfitLossService;

    public function __construct(
        GetUserPortfolioService $getUserPortfolioService,
        GetPortfolioCurrentValueService $getPortfolioCurrentValueService,
        GetStocksProportionService $getStocksProportionService,
        GetProfitLossService $getProfitLossService
    )
    {
        $this->getUserPortfolioService = $getUserPortfolioService;
        $this->getPortfolioCurrentValueService = $getPortfolioCurrentValueService;
        $this->getStocksProportionService = $getStocksProportionService;
        $this->getProfitLossService = $getProfitLossService;
    }

    public function index(): View
    {
        $user = auth()->user();
        $funds = UserFunds::where("user_id", $user->getAuthIdentifier())->firstOrFail()->funds / 100;
        $purchaseValue = UserStock::where("user_id", $user->getAuthIdentifier())->sum("purchase_value");
        $portfolioEntries = $this->getUserPortfolioService->execute()->all();
        $currentValue = $this->getPortfolioCurrentValueService->execute($portfolioEntries);
        $stocksProportion = $this->getStocksProportionService->execute($portfolioEntries);
        $profitLoss = $this->getProfitLossService->execute($portfolioEntries);
        return view("dashboard", [
            "user" => $user,
            "funds" => $funds,
            "purchaseValue" => $purchaseValue,
            "currentValue" => $currentValue,
            "stocksProportion" => $stocksProportion,
            "profitLoss" => $profitLoss
        ]);
    }
}
