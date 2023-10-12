<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function all()
    {
        return Task::all();
    }

    public function getByUser(Task $task)
    {
        return Task::with('user')->where('user_id'. $task->user_id);
    }

    public function getByCategory(Task $task)
    {
        return Task::with('category')->where('category_id'. $task->category_id);
    }
}
