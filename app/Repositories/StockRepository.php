<?php

namespace App\Repositories;

use App\Models\Collections\CompaniesCollection;
use App\Models\CompanyProfile;

interface StockRepository
{
    public function searchCompanies(string $name): CompaniesCollection;
    public function getCompanyProfile(string $symbol): CompanyProfile;
}
