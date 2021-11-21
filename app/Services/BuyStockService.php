<?php

namespace App\Services;

use App\Events\StockWasPurchased;
use App\Http\Requests\BuyStockRequest;
use App\Models\User;
use App\Models\UserFunds;
use App\Models\UserStock;
use App\Models\UserTransaction;
use App\Repositories\StockRepository;

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

        $funds = UserFunds::where("user_id", $user->getAuthIdentifier())->firstOrFail();

        $funds->update(["funds" => $funds->funds - $quote * 100 * $amount]);

        $userStock = UserStock::where("user_id", $user->getAuthIdentifier())->firstWhere("stock_symbol", $symbol);

        if (!$userStock)
        {
            $userStock = new UserStock ([
                "stock_symbol" => $symbol,
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

        $userTransaction = new UserTransaction([
            "transaction_type" => "buy",
            "stock_symbol" => $symbol,
            "amount" => $amount,
            "stock_price" => $quote
        ]);
        $userTransaction->user()->associate($user);
        $userTransaction->save();

        $user = User::find($user->getAuthIdentifier());
        event(new StockWasPurchased($user->email, $symbol, $amount));
    }

}
