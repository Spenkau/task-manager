<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
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

    public function create(mixed $data)
    {
        $this->userRepo->create($data);
    }

    public function getAllUsers()
    {
        return $this->userRepo->getAllUsers();
    }

//    public function getUserData(string $username)
//    {
//        return $this->userRepo->getUserData($username);
//    }
}
