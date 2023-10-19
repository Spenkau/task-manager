<?php

namespace App\Repositories;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\DTO\TaskDTO;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
        // TODO Изменить решение получения тасков с именем категории
    public function allOrParent(string $relation)
    {
        if ($relation === 'all') {
            return Task::all();
        }

        return Task::whereParentId(null)
            ->with($relation)
            ->with('category')
            ->get();
    }

    public function store(mixed $data)
    {
        Task::create($data);
    }

    public function show(int $taskId)
    {
        return Task::find($taskId);
    }

    public function showByCategory($categoryId)
    {
        return Task::where('category_id', $categoryId)
            ->get();
    }

    public function update(Task $task, $data)
    {
        $task->update($data);
    }

    public function softDelete(Task $task)
    {
        $task->delete();
    }

    public function getByUser(Task $task)
    {
        return Task::with('user')->where('user_id' . $task->user_id)->toArray();
    }

    public function getByCategory(Task $task)
    {
        return Task::with('category')->where('category_id' . $task->category_id)->toArray();
    }
}
