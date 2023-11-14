<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show()
    {
//        $user = $this->userService->show($email);

        $user = JWTAuth::parseToken()->authenticate();

        try {
            return response()->json(['user' => $user]);
        } catch (Exception $e) {
            return response()->json(['error' => 'User is not found: ' . $e]);
        }
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $response = $this->userService->create($data);
            return response()->json($response, $response['error'] ?? 403);
        } catch (Exception $e) {
            return response()->json(['error' => ['Something went wrong!', $e]]);
        }

//        try {
//            $this->userService->create($data);
//            return response()->json(['message' => 'User successfully created!']);
//        } catch (Exception $e) {
//            return response()->json(['error' => 'Failed to create new user: ' . $e]);
//        }
    }
}
