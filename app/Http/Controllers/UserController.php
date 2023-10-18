<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        dump($users);
    }

    public function show(User $user)
    {
        $user = $this->userService->getUser($user->id);

        dump($user);
    }

    public function showUserTasks(User $user)
    {
        $userTasks = $this->userService->getUserTasks($user->name);
    }
}
