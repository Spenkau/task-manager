<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Category;
use App\Models\Task;
use App\Repositories\TagRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Exception;

class TagService
{
    protected TagRepository $tagRepo;
    protected TaskRepository $taskRepo;

    public function __construct(TagRepository $tagRepo, TaskRepository $taskRepo)
    {
        $this->tagRepo = $tagRepo;
        $this->taskRepo = $taskRepo;
    }

    public function index()
    {
        return $this->tagRepo->index();
    }

    public function showTasks(string $selectedTags)
    {
        return $this->taskRepo->showByTags($selectedTags);
    }
}
