<?php

namespace App\Models\Collections;

use App\Models\UserPortfolioEntry;
use Illuminate\Database\Eloquent\Collection;


class UserPortfolioEntryCollection
{
    private array $portfolio = [];

    public function __construct($portfolio = [])
    {
        foreach ($portfolio as $entry)
        {
            if ($entry instanceof UserPortfolioEntry)
            {
                $this->add($entry);
            }
        }
    }

    public function add(UserPortfolioEntry $entry): void
    {
        $this->portfolio[] = $entry;
    }

    public function getPortfolio(): array
    {
        return $this->portfolio;
    }
}
