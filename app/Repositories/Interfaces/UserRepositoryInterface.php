<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
interface UserRepositoryInterface
{
    public function getAllUsers(): array;

    public function getUser(int $taskId): array;

    public function getUserTasks(string $userName): array;
}
