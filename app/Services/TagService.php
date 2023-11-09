<?php

namespace App\Services;

use App\Http\Resources\TagResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Category;
use App\Models\Tag;
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

    public function store(mixed $data)
    {
        $this->tagRepo->store($data);
    }

    public function update(mixed $data)
    {
        $this->tagRepo->update($data);
    }

    public function delete(int $id)
    {
        $this->tagRepo->delete($id);
    }

}
