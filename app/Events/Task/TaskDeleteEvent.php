<?php

namespace App\Events\Task;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskDeleteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $id;

    /**
     * Create a new event instance.
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Return name of broadcast event
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'task.deleted';
    }

    /**
     * Return data received from params
     *
     * @return Task[]
     */
    public function broadcastWith(): array
    {
        return ['task_id' => $this->id];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('task-channel'),
        ];
    }
}
