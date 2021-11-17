<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PrivateEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    use InteractsWithQueue;

    private string $message;
    private string $emailFrom;

    public function __construct(string $message, string $emailFrom)
    {
        //
        $this->message = $message;
        $this->emailFrom = $emailFrom;
    }

    public function build()
    {
        return $this->from($this->emailFrom)
            ->subject('Private message')
            ->markdown('mail.name', ['message' => $this->message]);
    }
}
