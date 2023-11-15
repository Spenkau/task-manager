<?php

namespace App\Mail;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskReminder extends Mailable
{
    use Queueable, SerializesModels;

    public TaskResource $task;

    public function __construct(TaskResource $task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->view(
            view: 'emails.task_reminder',
            data: ['task' => $this->task]
        );
    }
}
