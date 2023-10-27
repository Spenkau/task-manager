<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ButtonClicked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;

    /**
     * Create a new event instance.
     */
    public function __construct(string $message) {
        $this->message = $message;
    }


    /**
     * Return name of broadcast event
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'button.clicked';
    }

    /**
     * Return data for transaction
     *
     * @return string[]
     */
    public function broadcastWith(): array
    {
        return ['message' => $this->message];
    }

    /**
     * Activate broadcast if the condition is met
     *
     * @return bool
     */
//    public function broadcastWhen()
//    {
//        return strlen($this->message) > 3;
//    }

    /**
     * Return event channel
     *
     * @return Channel[]
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('public'),
        ];
    }
}
