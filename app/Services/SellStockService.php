<?php

namespace App\Services;

use App\Models\UserFunds;
use App\Models\UserStock;
use App\Models\UserTransaction;
use App\Repositories\StockRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class SellStockService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $amount, string $symbol): void
    {
        $user = auth()->user();
        $quote = $this->repository->getStockQuote($symbol)->quote;

        $this->updateUserFunds($user, $quote, $amount);
        $this->updateUserStock($user, $symbol, $amount);
        $this->updateUserTransactions($user, $symbol, $amount, $quote);
    }

    private function updateUserFunds(Authenticatable $user, float $quote, int $amount): void
    {
        $funds = UserFunds::where("user_id", $user->getAuthIdentifier())->firstOrFail();
        $funds->update(["funds" => $funds->funds + $quote * 100 * $amount]);
    }

    private function updateUserStock(Authenticatable $user, string $symbol, int $amount): void
    {
        $userStock = UserStock::where("user_id", $user->getAuthIdentifier())->firstWhere("stock_symbol", $symbol);
        if ($userStock->amount === $amount)
        {
            $userStock->delete();
        } else {
            $averagePrice = $userStock->purchase_value / $userStock->amount;

            $userStock->update([
                "amount" => $userStock->amount - $amount,
                "purchase_value" => $userStock->purchase_value - $averagePrice * $amount
            ]);
        }
    }

    private function updateUserTransactions(Authenticatable $user, string $symbol, int $amount, float $quote)
    {
        $userTransaction = new UserTransaction([
            "transaction_type" => "sell",
            "stock_symbol" => $symbol,
            "company_name" => $this->repository->getCompanyName($symbol),
            "amount" => $amount,
            "stock_price" => $quote
        ]);
        $userTransaction->user()->associate($user);
        $userTransaction->save();
    }
}
