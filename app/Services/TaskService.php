<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Category;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;

class TaskService
{
    protected $taskRepo;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepo = $taskRepository;
    }

    public function allOrParent(string $relation)
    {
        return new TaskResourceCollection($this->taskRepo->allOrParent($relation));
    }

    public function show(int $taskId)
    {
        return new TaskResource($this->taskRepo->show($taskId));
    }

    public function showByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return new TaskResourceCollection($this->taskRepo->showByCategory($category->id));
    }

    public function store(mixed $data)
    {
        $this->taskRepo->store($data);
    }

    public function update(Task $task, $data)
    {
        $this->taskRepo->update($task, $data);
    }

    public function softDelete(Task $task)
    {
        $this->taskRepo->softDelete($task);
    }
}
