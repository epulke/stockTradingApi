<?php

namespace App\Models;

class UserPortfolioEntry
{
    private UserStock $userStock;
    private CompanyStockQuote $quote;
    private float $currentValue;
    private float $profitLoss;
    private float $percentageProfitLoss;

    public function __construct(UserStock $userStock, CompanyStockQuote $quote)
    {
        $this->userStock = $userStock;
        $this->quote = $quote;
        $this->currentValue = $userStock->amount * $quote->quote;
        $this->profitLoss = $this->currentValue - $userStock->purchase_value;
        $this->percentageProfitLoss = $this->profitLoss / $userStock->purchase_value * 100;
    }

    public function getUserStock(): UserStock
    {
        return $this->userStock;
    }

    public function getQuote(): CompanyStockQuote
    {
        return $this->quote;
    }

    public function getCurrentValue()
    {
        return $this->currentValue;
    }

    public function getProfitLoss()
    {
        return $this->profitLoss;
    }

    public function getPercentageProfitLoss()
    {
        return $this->percentageProfitLoss;
    }
}
