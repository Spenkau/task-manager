<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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

        try {
//            User::create($data);

            $this->userService->create($data);
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create a new user: ' . $e]);
        }


//        try {
//            $this->userService->create($data);
//            return response()->json(['message' => 'User successfully created!']);
//        } catch (Exception $e) {
//            return response()->json(['error' => 'Failed to create new user: ' . $e]);
//        }
    }
}
