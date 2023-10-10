<?php

namespace App\Services\Task;

use App\Models\Task;

class Service
{
    public function show()
    {
        return Task::with('category')->get();
    }

    public function store($data)
    {
        Task::create($data);

    }

    public function update($task, $data)
    {
        $task->update($data);
    }
}
