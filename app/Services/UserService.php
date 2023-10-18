<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Category;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Exception;

class UserService
{
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers(): array
    {
        return $this->userRepo->getAllUsers();
    }

    public function getUser(int $taskId): array
    {
        return $this->userRepo->getUser($taskId);
    }

    public function getUserTasks(string $userName): array
    {
        return $this->userRepo->getUserTasks($userName);
    }
}
