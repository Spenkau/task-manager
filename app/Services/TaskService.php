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
        return new TaskResourceCollection($this->taskRepo->allOrParent($relation));
    }

    public function show(int $taskId)
    {
        return new TaskResource($this->taskRepo->show($taskId));
    }

    public function showByCategory(string $slug)
    {
        $category = $this->categoryRepo->findOne($slug);

        return new TaskResourceCollection($this->taskRepo->showByCategory($category->id));
    }

    public function showByTags(Tag $tag)
    {
        // TODO сделать получение тегов
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
