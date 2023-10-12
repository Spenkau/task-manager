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

    public function all()
    {
        return $this->taskRepo->all();
    }

    public function tasksBySlug(Request $request)
    {
        $categorySlug = $request->getQuery('category');

        $categoryId = Category::where('slug', $categorySlug)->value('id');

        return Task::where('category_id', $categoryId)->get();
    }
}
