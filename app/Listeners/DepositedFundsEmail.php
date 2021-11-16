<?php

namespace App\Listeners;

use App\Events\FundsWereDeposited;
use App\Mail\FundsEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DepositedFundsEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(FundsWereDeposited $event)
    {
        Mail::to($event->getEmail())->send(new FundsEmail($event->getDeposit()));
    }
}
