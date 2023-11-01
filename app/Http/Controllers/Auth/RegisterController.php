<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\User\StoreRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected UserService $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return JsonResponse
     */
    protected function create(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $this->userService->create($data);
            return response()->json(['message' => 'User successfully created!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create new user: ' . $e]);
        }
    }
}
