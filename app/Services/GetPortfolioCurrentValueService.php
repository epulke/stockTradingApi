<?php

namespace App\Services;

use App\Models\UserPortfolioEntry;

class GetPortfolioCurrentValueService
{
    public function execute(array $portfolioEntries): float
    {
        $currentValue = 0;
        foreach ($portfolioEntries as $entry)
        {
            /** @var UserPortfolioEntry $entry */
            $currentValue += $entry->getCurrentValue();
        }
        return $currentValue;
    }
}
