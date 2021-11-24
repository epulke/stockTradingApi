<?php

namespace App\Repositories;

use App\Models\Collections\CompaniesCollection;
use App\Models\CompanyProfile;
use App\Models\CompanyStockQuote;

interface StockRepository
{
    public function searchCompanies(string $name): CompaniesCollection;
    public function getCompanyProfile(string $symbol): CompanyProfile;
    public function getStockQuote(string $symbol): CompanyStockQuote;
    public function getCompanyName(string $symbol): String;
}
