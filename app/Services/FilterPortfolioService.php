<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

class FilterPortfolioService
{
    private GetUserPortfolioService $getUserPortfolioService;
    private PaginationHelpService $paginationHelpService;

    public function __construct(
        GetUserPortfolioService $getUserPortfolioService,
        PaginationHelpService $paginationHelpService
    )
    {
        $this->getUserPortfolioService = $getUserPortfolioService;
        $this->paginationHelpService = $paginationHelpService;
    }

    public function execute(string $position, string $type): LengthAwarePaginator
    {
        $portfolio = ($this->getUserPortfolioService->execute());
        if ($type === "ascending")
        {
            switch ($position)
            {
                case "stockSymbol":
                    $portfolioSorted = $portfolio->sortBy(function($item) {
                        return $item->getUserStock()->stock_symbol;
                    });
                    break;
                case "amount":
                    $portfolioSorted = $portfolio->sortBy(function($item) {
                        return $item->getUserStock()->amount; });
                    break;
                case "purchaseValue":
                    $portfolioSorted = $portfolio->sortBy(function($item) {
                        return $item->getUserStock()->purchase_value; });
                    break;
                case "currentValue":
                    $portfolioSorted = $portfolio->sortBy(function($item) {
                        return $item->getCurrentValue(); });
                    break;
                case "profitloss":
                    $portfolioSorted = $portfolio->sortBy(function($item) {
                        return $item->getProfitLoss(); });
                    break;
                case "quote":
                    $portfolioSorted = $portfolio->sortBy(function($item) {
                        return $item->getQuote()->quote; });
                    break;
            }
        }

        if ($type === "descending")
        {
            switch ($position)
            {
                case "stockSymbol":
                    $portfolioSorted = $portfolio->sortByDesc(function($item) {
                        return $item->getUserStock()->stock_symbol;
                    });
                    break;
                case "amount":
                    $portfolioSorted = $portfolio->sortByDesc(function($item) {
                        return $item->getUserStock()->amount; });
                    break;
                case "purchaseValue":
                    $portfolioSorted = $portfolio->sortByDesc(function($item) {
                        return $item->getUserStock()->purchase_value; });
                    break;
                case "currentValue":
                    $portfolioSorted = $portfolio->sortByDesc(function($item) {
                        return $item->getCurrentValue(); });
                    break;
                case "profitloss":
                    $portfolioSorted = $portfolio->sortByDesc(function($item) {
                        return $item->getProfitLoss(); });
                    break;
                case "quote":
                    $portfolioSorted = $portfolio->sortByDesc(function($item) {
                        return $item->getQuote()->quote; });
                    break;
            }
        }

        $portfolioPaginated = $this->paginationHelpService->paginate($portfolioSorted, 10);

        return $portfolioPaginated;
    }
}
