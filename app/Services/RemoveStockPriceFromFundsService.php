<?php

namespace App\Services;

use App\Models\UserFunds;

class RemoveStockPriceFromFundsService
{
    public function execute(float $quote, int $amount)
    {
        $funds = UserFunds::where("user_id", auth()->user()->getAuthIdentifier())->firstOrFail();
        // TODO pielikt validator, ka nevar nopirkt, ja nepietiek funds
        $funds->update(["funds" => $funds->funds - $quote * 100 * $amount]);
    }
}
