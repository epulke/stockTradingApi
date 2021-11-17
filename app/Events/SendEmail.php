<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    private string $email;
    private string $message;
    private string $emailFrom;

    public function __construct(string $email, string $message, string $emailFrom)
    {
        $this->email = $email;
        $this->message = $message;
        $this->emailFrom = $emailFrom;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getEmailFrom(): string
    {
        return $this->emailFrom;
    }
}
