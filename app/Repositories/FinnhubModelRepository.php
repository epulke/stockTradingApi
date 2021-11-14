<?php

namespace App\Repositories;

use App\Models\Collections\StocksCollection;
use App\Models\Stock;
use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;

class FinnhubModelRepository
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

    public function getStock(string $name): StocksCollection
    {
        $stocks = $this->finnhub->symbolSearch($name)->getResult();

        $collection = new StocksCollection();

        foreach ($stocks as $stock)
        {
            $collection->add(
                new Stock([
                    "name" => $stock->getDescription(),
                    "symbol" => $stock->getSymbol(),
                    "currentQuote" => 0
                ])
            );

        }

        return $collection;
    }


    public function getStockPrice(string $symbol): float
    {
        return $this->finnhub->quote($symbol)->getC();
    }
}
