<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FundsWereDeposited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $email;
    private int $deposit;

    public function __construct(string $email, int $deposit)
    {
        $this->email = $email;
        $this->deposit = $deposit;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDeposit(): int
    {
        return $this->deposit;
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
