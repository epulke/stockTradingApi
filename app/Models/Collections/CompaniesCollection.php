<?php

namespace App\Models\Collections;

use App\Models\Company;

class CompaniesCollection
{
    private array $stocksCollection = [];

    public function __construct(array $stocksCollection = [])
    {
        foreach ($stocksCollection as $stock)
        {
            if($stock instanceof Company)
            {
                $this->add($stock);
            }
        }
    }

    public function add(Company $stock)
    {
        $this->stocksCollection[] = $stock;
    }

    public function getStocksCollection(): array
    {
        return $this->stocksCollection;
    }
}
