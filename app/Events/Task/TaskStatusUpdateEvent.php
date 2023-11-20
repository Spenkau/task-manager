<?php

namespace App\Events\Task;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskStatusUpdateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private TaskResource $task;

    /**
     * Create a new event instance.
     */
    public function __construct(TaskResource $task)
    {
        $this->task = $task;
    }

    /**
     * Return name of broadcast event
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'task.status_updated';
    }

    /**
     * Return data received from params
     *
     * @return Task[]
     */
    public function broadcastWith(): array
    {
        return ['task' => $this->task];
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
