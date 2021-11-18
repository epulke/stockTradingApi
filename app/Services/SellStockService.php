<?php

namespace App\Services;

use App\Models\UserFunds;
use App\Models\UserStock;
use App\Models\UserTransaction;
use App\Repositories\StockRepository;

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
        // TODO šeit jāvalidē, ka nevar pārdot vairāk nekā viņam ir
        $quote = $this->repository->getStockQuote($symbol)->quote;

        $funds = UserFunds::where("user_id", $user->getAuthIdentifier())->firstOrFail();
        $funds->update(["funds" => $funds->funds + $quote * 100 * $amount]);

        $userStock = UserStock::where("user_id", $user->getAuthIdentifier())->firstWhere("stock_symbol", $symbol);
        $purchasePrice = $userStock->purchase_value / $userStock->amount;

        $userStock->update([
            "amount" => $userStock->amount - $amount,
            "purchase_value" => $userStock->purchase_value - $purchasePrice * $amount
        ]);

        $userTransaction = new UserTransaction([
            "transaction_type" => "sell",
            "stock_symbol" => $symbol,
            "amount" => $amount,
            "stock_price" => $quote
        ]);
        $userTransaction->user()->associate($user);
        $userTransaction->save();
    }
}
