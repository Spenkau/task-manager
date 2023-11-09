<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function allOrParent(string $relation, int $userId);

    public function show(int $taskId);

    public function showByCategory($categoryId);

    public function store(mixed $data);

    public function update(mixed $data);

    public function delete(int $id);

    public function getByCategory(Task $task);

    public function finish(mixed $data);

//    public function filterTasks(string $field);
}
