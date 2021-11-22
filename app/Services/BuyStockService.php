<?php

namespace App\Services;

use App\Events\StockWasPurchased;
use App\Models\User;
use App\Models\UserFunds;
use App\Models\UserStock;
use App\Models\UserTransaction;
use App\Repositories\StockRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class BuyStockService
{
    private StockRepository $repository;

    public function __construct(
        StockRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function execute(int $amount, string $symbol): void
    {
        $user = auth()->user();
        $quote = $this->repository->getStockQuote($symbol)->quote;

        $this->updateFunds($user, $quote, $amount);
        $this->updateUserStock($user, $symbol, $amount, $quote);
        $this->updateUserTransactions($symbol, $amount, $quote, $user);

        $user = User::find($user->getAuthIdentifier());
        event(new StockWasPurchased($user->email, $symbol, $amount));
    }

    private function updateFunds(Authenticatable $user, float $quote, int $amount): void
    {
        $funds = UserFunds::where("user_id", $user->getAuthIdentifier())->firstOrFail();
        $funds->update(["funds" => $funds->funds - $quote * 100 * $amount]);
    }

    private function updateUserStock(Authenticatable $user, string $symbol, int $amount, float $quote): void
    {
        $userStock = UserStock::where("user_id", $user->getAuthIdentifier())->firstWhere("stock_symbol", $symbol);

        if (!$userStock)
        {
            $userStock = new UserStock ([
                "stock_symbol" => $symbol,
                "company_name" => $this->repository->getCompanyName($symbol),
                "amount" => $amount,
                "purchase_value" => $amount * $quote
            ]);
            $userStock->user()->associate($user);
            $userStock->save();
        } else {
            $userStock->update([
                "amount" => $userStock->amount + $amount,
                "purchase_value" => $userStock->purchase_value + $amount * $quote,
            ]);
        }
    }

    private function updateUserTransactions(string $symbol, int $amount, float $quote, Authenticatable $user): void
    {
        $userTransaction = new UserTransaction([
            "transaction_type" => "buy",
            "stock_symbol" => $symbol,
            "company_name" => $this->repository->getCompanyName($symbol),
            "amount" => $amount,
            "stock_price" => $quote
        ]);
        $userTransaction->user()->associate($user);
        $userTransaction->save();
    }
}
