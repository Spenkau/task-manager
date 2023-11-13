<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    protected TaskRepository $taskRepo;
    protected CategoryRepository $categoryRepo;

    public function __construct(TaskRepository $taskRepo, CategoryRepository $categoryRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function all(array $data)
    {
        return $this->taskRepo->all($data);
    }

    public function store(array $data)
    {
        return $this->taskRepo->store($data);
    }

    public function update(array $data)
    {
        return $this->taskRepo->update($data);
    }

    public function delete(Task $task)
    {
        $this->taskRepo->delete($task);
    }

    public function show(int $taskId)
    {
        return new TaskResource($this->taskRepo->show($taskId));
    }

    public function showByCategory(string $slug)
    {
        $categoryId = $this->categoryRepo->findOne($slug);

        return $this->taskRepo->showByCategory($categoryId);
    }

    public function filter(array $data)
    {
        return $this->taskRepo->filter($data);
    }

    public function manageStatus(mixed $data)
    {
        return $this->taskRepo->manageStatus($data);
    }
}
