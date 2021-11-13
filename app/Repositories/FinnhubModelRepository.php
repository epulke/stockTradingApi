<?php

namespace App\Repositories;

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

    public function getStockQuote(string $symbol): float
    {
        return $this->finnhub->quote($symbol)->getC();
    }
}
