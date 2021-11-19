<?php

namespace App\Listeners;

use App\Events\FundsWereWithdrawn;
use App\Mail\DepositEmail;
use App\Mail\WithdrawEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class WithdrawnFundsEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(FundsWereWithdrawn $event)
    {
        Mail::to($event->getEmail())->send(new WithdrawEmail($event->getWithdrawal()));
    }
}
