<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchasedStockEmail extends Mailable
{
    use Queueable, SerializesModels;

    private string $stock;
    private int $amount;

    public function __construct(string $stock, int $amount)
    {
        $this->stock = $stock;
        $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("info@stocktrader.com")
                    ->subject("You have purchased stock")
                    ->markdown("mail.purchased-stock-email", ["stock" => $this->stock, "amount" => $this->amount]);
    }
}
