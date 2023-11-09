<?php

namespace App\Repositories\Interfaces;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function allOrParent(string $relation, int $userId);

    public function show(int $taskId);

    public function showByCategory($categoryId);

    public function store(array $data);

    public function update(array $data);

    public function delete(Task $task);

    public function getByCategory(Task $task);

    public function manageStatus(array $data);

//    public function filterTasks(string $field);
}
