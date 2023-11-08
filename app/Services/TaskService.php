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

class TaskService
{
    protected $taskRepo;
    protected $categoryRepo;

    public function __construct(TaskRepository $taskRepo, CategoryRepository $categoryRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function allOrParent(string $relation)
    {
        return $this->taskRepo->allOrParent($relation);
    }

    public function show(int $taskId)
    {
        return new TaskResource($this->taskRepo->show($taskId));
    }

    public function showByCategory(string $slug)
    {
        $category = $this->categoryRepo->findOne($slug);

        return TaskResource::collection($this->taskRepo->showByCategory($category->id));
    }

    public function store(mixed $data)
    {
        return $this->taskRepo->store($data);
    }

    public function update(mixed $data)
    {
        $this->taskRepo->update($data);
    }

    public function softDelete(Task $task)
    {
        $this->taskRepo->softDelete($task);
    }

    public function finish(mixed $data)
    {
        $this->taskRepo->finish($data);
    }

    public function filterTasks(string $field)
    {
        return $this->taskRepo->filterTasks($field);
    }

}
