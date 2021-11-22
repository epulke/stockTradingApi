<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
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
            $portfolioSorted = $this->sortAscending($position, $portfolio);
        }

        if ($type === "descending")
        {
            $portfolioSorted = $this->sortDescending($position, $portfolio);
        }

        $portfolioPaginated = $this->paginationHelpService->paginate($portfolioSorted, 10);

        return $portfolioPaginated;
    }

    private function sortAscending(string $position, Collection $portfolio): Collection
    {
        switch ($position)
        {
            case "companyName":
                return  $portfolio->sortBy(function($item) {
                    return $item->getUserStock()->company_name;});
            case "companySymbol":
                return  $portfolio->sortBy(function($item) {
                    return $item->getUserStock()->stock_symbol;});
            case "amount":
                return  $portfolio->sortBy(function($item) {
                    return $item->getUserStock()->amount; });
            case "purchaseValue":
                return  $portfolio->sortBy(function($item) {
                    return $item->getUserStock()->purchase_value; });
            case "currentValue":
                return  $portfolio->sortBy(function($item) {
                    return $item->getCurrentValue(); });
            case "profitloss":
                return  $portfolio->sortBy(function($item) {
                    return $item->getProfitLoss(); });
            case "quote":
                return $portfolio->sortBy(function($item) {
                    return $item->getQuote()->quote; });
        }
    }

    private function sortDescending(string $position, Collection $portfolio): Collection
    {
        switch ($position)
        {
            case "companyName":
                return  $portfolio->sortByDesc(function($item) {
                    return $item->getUserStock()->company_name;});
            case "stockSymbol":
                return $portfolio->sortByDesc(function($item) {
                    return $item->getUserStock()->stock_symbol;
                });
            case "amount":
                return $portfolio->sortByDesc(function($item) {
                    return $item->getUserStock()->amount; });
            case "purchaseValue":
                return $portfolio->sortByDesc(function($item) {
                    return $item->getUserStock()->purchase_value; });
            case "currentValue":
                return $portfolio->sortByDesc(function($item) {
                    return $item->getCurrentValue(); });
            case "profitloss":
                return $portfolio->sortByDesc(function($item) {
                    return $item->getProfitLoss(); });
            case "quote":
                return $portfolio->sortByDesc(function($item) {
                    return $item->getQuote()->quote; });
        }
    }
}
