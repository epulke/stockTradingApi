<?php

namespace App\Listeners;

use App\Events\SendEmail;
use App\Mail\PrivateEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UserSendEmailRequest implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(SendEmail $event)
    {
       Mail::to($event->getEmail())->send(new PrivateEmail($event->getMessage(), $event->getEmailFrom()));


    }
}
