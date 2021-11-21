<?php

namespace App\Services;

use App\Listeners\StockWasPurchasedEmail;
use App\Models\Collections\UserPortfolioEntryCollection;
use App\Models\UserPortfolioEntry;
use App\Repositories\StockRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GetUserPortfolioService
{
    private StockRepository $repository;

    public function __construct(StockRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): Collection
    {
        $portfolio = new Collection();
        $stocks = auth()->user()->stocks()->get();

        foreach ($stocks as $stock)
        {
            $entry = new UserPortfolioEntry($stock, $this->repository->getStockQuote($stock->stock_symbol));
            $portfolio->add($entry);
        }

        return $portfolio;
    }
}
