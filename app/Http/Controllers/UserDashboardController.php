<?php

namespace App\Http\Controllers;

use App\Models\UserFunds;
use App\Models\UserPortfolioEntry;
use App\Models\UserStock;
use App\Services\GetUserPortfolioService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    private GetUserPortfolioService $getUserPortfolioService;

    public function __construct(GetUserPortfolioService $getUserPortfolioService)
    {
        $this->getUserPortfolioService = $getUserPortfolioService;
    }


    public function index(): View
    {
        $user = auth()->user();
        $funds = UserFunds::where("user_id", $user->getAuthIdentifier())->firstOrFail()->funds / 100;
        $purchaseValue = UserStock::where("user_id", $user->getAuthIdentifier())->sum("purchase_value");
        $portfolioEntries = $this->getUserPortfolioService->execute()->all();
        $currentValue = 0;
        $stocksProportion = [];
        $profitLoss = 0;
        foreach ($portfolioEntries as $entry)
        {
            /** @var UserPortfolioEntry $entry */
            $currentValue += $entry->getCurrentValue();
            $profitLoss += $entry->getProfitLoss();
        }
        foreach ($portfolioEntries as $entry)
        {
            $stocksProportion[] = [$entry->getUserStock()->stock_symbol, $entry->getCurrentValue()];
        }
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
