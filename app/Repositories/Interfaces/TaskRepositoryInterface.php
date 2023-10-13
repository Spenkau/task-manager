<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
interface TaskRepositoryInterface
{
    public function allOrParent(string $relation);

    public function store(mixed $data);
    public function show(int $taskId);
    public function getByUser(Task $task);
    public function getByCategory(Task $task);
}
