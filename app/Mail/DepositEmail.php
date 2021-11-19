<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepositEmail extends Mailable
{
    use Queueable, SerializesModels;


    private int $deposit;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $deposit)
    {
        $this->deposit = $deposit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("info@stocktrader.com")
                    ->subject("Funds deposited in your account")
                    ->markdown('mail.deposit-email', ["deposit" => $this->deposit]);
    }
}
