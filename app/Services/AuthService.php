<?php

namespace App\Services;

use App\Http\Resources\TagResource;
use App\Http\Resources\TagResourceCollection;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Category;
use App\Models\Task;
use App\Repositories\AuthRepository;
use App\Repositories\TagRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Exception;

class AuthService
{
    protected AuthRepository $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

}
