<?php

namespace App\Services;

use App\Http\Resources\TaskResource;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Exception;

class AdminService
{
    protected AdminRepository $adminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function getAllUsers()
    {
        return $this->adminRepo->getAllUsers();
    }

//    public function getUserData(string $username)
//    {
//        return $this->userRepo->getUserData($username);
//    }
}
