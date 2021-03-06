<?php

namespace App\Providers;

use App\Events\FundsWereDeposited;
use App\Events\FundsWereWithdrawn;
use App\Events\StockWasPurchased;
use App\Listeners\DepositedFundsEmail;
use App\Listeners\StockWasPurchasedEmail;
use App\Listeners\WithdrawnFundsEmail;
use App\Services\WithdrawFundsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        FundsWereDeposited::class => [
            DepositedFundsEmail::class
        ],
        FundsWereWithdrawn::class => [
            WithdrawnFundsEmail::class
        ],
        StockWasPurchased::class => [
            StockWasPurchasedEmail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
