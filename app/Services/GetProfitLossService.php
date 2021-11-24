<?php

namespace App\Services;

use App\Models\UserPortfolioEntry;

class GetProfitLossService
{
    public function execute(array $portfolioEntries): float
    {
        $profitLoss = 0;
        foreach ($portfolioEntries as $entry)
        {
            /** @var UserPortfolioEntry $entry */
            $profitLoss += $entry->getProfitLoss();
        }
        return $profitLoss;
    }
}
