<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockWasPurchased
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $email;
    private string $stock;
    private int $amount;

    public function __construct(string $email, string $stock, int $amount)
    {
        $this->email = $email;
        $this->stock = $stock;
        $this->amount = $amount;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStock(): string
    {
        return $this->stock;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
