<?php

namespace App\Repositories;

use App\Models\Collections\CompaniesCollection;
use App\Models\Company;
use App\Models\CompanyProfile;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;


class FinnhubModelRepository implements StockRepository
{
    private DefaultApi $finnhub;

    public function __construct()
    {
        //TODO iznest ārā key uz .env failu vai vēl kaut kur
        $config = Configuration::getDefaultConfiguration()->setApiKey('token', 'c66nbq2ad3icr57jk5dg');
        $this->finnhub = new DefaultApi(
            new Client(),
            $config);
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
        cache()->put($cacheKey, $collection, now()->addHour());

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

        cache()->put($cacheKey, $companyProfile, now()->addHour());

        return $companyProfile;
    }
}
