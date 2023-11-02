<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use http\Client\Request;

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

//    public function show(User $user)
//    {
//        $user = $this->userService->getUserData($user->name);
//
//        try {
//            return response()->json(['user' => $user]);
//        } catch (Exception $e) {
//            return response()->json(['error' => 'User is not found: ' . $e]);
//        }
//    }

    public function create(StoreRequest $request)
    {
        $data = $request->validated();

        return response()->json(['message' => 'SUCCESS', 'data' => $data]);

//        try {
//            $this->userService->create($data);
//            return response()->json(['message' => 'User successfully created!']);
//        } catch (Exception $e) {
//            return response()->json(['error' => 'Failed to create new user: ' . $e]);
//        }
    }
}
