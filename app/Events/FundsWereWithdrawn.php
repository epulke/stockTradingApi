<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FundsWereWithdrawn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $email;
    private int $withdrawal;

    public function __construct(string $email, int $withdrawal)
    {
        $this->email = $email;
        $this->withdrawal = $withdrawal;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getWithdrawal(): int
    {
        return $this->withdrawal;
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
