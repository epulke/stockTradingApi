<?php

namespace App\Providers;

use App\Repositories\FinnhubModelRepository;
use App\Repositories\StockRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(StockRepository::class, FinnhubModelRepository::class);
    }


    public function boot()
    {
        //
    }
}
