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

    public function show(string $email)
    {
        return $this->userRepo->show($email);
    }

    public function create(mixed $data)
    {
        return $this->userRepo->store($data);
    }

//    public function getUserData(string $username)
//    {
//        return $this->userRepo->getUserData($username);
//    }
}
