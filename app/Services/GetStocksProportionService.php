<?php

namespace App\Services;

use App\Models\UserPortfolioEntry;

class GetStocksProportionService
{
    public function execute(array $portfolioEntries): array
    {
        $stocksProportion = [];
        foreach ($portfolioEntries as $entry)
        {
            /** @var UserPortfolioEntry $entry */
            $stocksProportion[] = [$entry->getUserStock()->stock_symbol, $entry->getCurrentValue()];
        }
        return $stocksProportion;
    }
}
