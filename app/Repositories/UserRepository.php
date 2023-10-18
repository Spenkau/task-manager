<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): array
    {
        return User::all()->toArray();
    }

    public function getUser(int $taskId): array
    {
        return User::find($taskId)->toArray();
    }

    public function getUserTasks(string $userName): array
    {
        return User::where('name', $userName)
            ->with('tasks')
            ->get()
            ->toArray();
    }


}
