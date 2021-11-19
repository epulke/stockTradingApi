<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawEmail extends Mailable
{
    use Queueable, SerializesModels;

    private int $withdrawal;

    public function __construct(int $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("info@stocktrader.com")
            ->subject("Funds withdrawn from your account")
            ->markdown('mail.withdraw-email', ["withdrawal" => $this->withdrawal]);
    }
}
