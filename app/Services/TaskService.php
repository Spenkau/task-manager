<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Task;
use App\Repositories\TaskRepository;
use http\Env\Request;

class TaskService
{
    protected $taskRepo;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepo = $taskRepository;
    }

    public function allOrParent(string $relation)
    {
        return $this->taskRepo->allOrParent($relation);
    }

    public function show(int $taskId)
    {
        return $this->taskRepo->show($taskId);
    }

    public function tasksBySlug(Request $request)
    {
        $categorySlug = $request->getQuery('category');

        $categoryId = Category::where('slug', $categorySlug)->value('id');

        return Task::where('category_id', $categoryId)->get();
    }

    public function store(mixed $data)
    {
        $this->taskRepo->store($data);
    }
}
