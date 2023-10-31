<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserData(string $userName)
    {
        return User::where('name', $userName)
            ->with('tasks')
            ->get();
    }
}
