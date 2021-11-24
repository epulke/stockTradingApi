<?php

namespace App\Repositories;

use App\Models\Collections\CompaniesCollection;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\CompanyStockQuote;
use Finnhub\Api\DefaultApi;
use Illuminate\Support\Str;


class FinnhubModelRepository implements StockRepository
{
    private DefaultApi $finnhub;

    public function __construct(DefaultApi $finnhub)
    {
        $this->finnhub = $finnhub;
    }

    public function searchCompanies(string $name): CompaniesCollection
    {
        $companies = $this->finnhub->symbolSearch($name)->getResult();
        $cacheKey = "companies." . Str::snake($name);

        if (cache()->has($cacheKey)) return cache()->get($cacheKey);

        $collection = new CompaniesCollection();

        foreach ($companies as $company)
        {
            $collection->add(
                new Company([
                    "name" => $company->getDescription(),
                    "symbol" => $company->getSymbol()
                ])
            );

        }
        cache()->put($cacheKey, $collection, now()->addMinutes(30));

        return $collection;
    }


    public function getCompanyProfile(string $symbol): CompanyProfile
    {
        $company = $this->finnhub->companyProfile2($symbol);
        $cacheKey = "companies." . Str::snake($symbol);

        if (cache()->has($cacheKey)) return cache()->get($cacheKey);

        $companyProfile = new CompanyProfile([
            "name" => $company->getName(),
            "symbol" => $company->getTicker(),
            "currency" => $company->getCurrency(),
            "logoUrl" => $company->getLogo(),
            "webUrl" => $company->getWeburl(),
            "industry" => $company->getFinnhubIndustry(),
            "marketCapitalization" => $company->getMarketCapitalization()
        ]);

        cache()->put($cacheKey, $companyProfile, now()->addMinutes(30));

        return $companyProfile;
    }

    public function getStockQuote(string $symbol): CompanyStockQuote
    {
        $quote = new CompanyStockQuote([
            "symbol" => $symbol,
            "quote" => $this->finnhub->quote($symbol)->getC()
        ]);
        return $quote;
    }

    public function getCompanyName(string $symbol): String
    {
        return $this->finnhub->companyProfile2($symbol)->getName();
    }
}
