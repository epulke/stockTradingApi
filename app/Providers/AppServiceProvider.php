<?php

namespace App\Providers;

use App\Http\Requests\BuyStockRequest;
use App\Repositories\FinnhubModelRepository;
use App\Repositories\StockRepository;
use App\Rules\EnoughFunds;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(StockRepository::class, function () {
            $config = Configuration::getDefaultConfiguration()
                ->setApiKey('token', env("FINNHUB_API_KEY"));
            $client = new DefaultApi(
                new Client(),
                $config);
            return new FinnhubModelRepository($client);
        });

    }


    public function boot()
    {
        //
    }
}
