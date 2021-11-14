<?php

namespace App\Models\Collections;

use App\Models\Stock;

class StocksCollection
{
    private array $stocksCollection = [];

    public function __construct(array $stocksCollection = [])
    {
        foreach ($stocksCollection as $stock)
        {
            if($stock instanceof Stock)
            {
                $this->add($stock);
            }
        }
    }

    public function add(Stock $stock)
    {
        $this->stocksCollection[] = $stock;
    }

    public function getStocksCollection(): array
    {
        return $this->stocksCollection;
    }
}
