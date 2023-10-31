<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Exception;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        try {
            return response()->json(['users' => $users]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show users: ' . $e]);
        }
    }

    public function show(User $user)
    {
        $user = $this->userService->getUserData($user->name);

        try {
            return response()->json(['user' => $user]);
        } catch (Exception $e) {
            return response()->json(['error' => 'User is not found: ' . $e]);
        }
    }
}
