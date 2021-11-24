<?php

namespace App\Listeners;

use App\Events\StockWasPurchased;
use App\Mail\PurchasedStockEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class StockWasPurchasedEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(StockWasPurchased $event)
    {
        Mail::to($event->getEmail())->send(new PurchasedStockEmail($event->getStock(), $event->getAmount()));
    }
}
