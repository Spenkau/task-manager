<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function show(string $email)
    {
        return User::whereEmail($email)->first();
    }

    public function store(mixed $data)
    {
        $existedUser = $this->isUserExist($data['email']);

        if ($existedUser) {
            return ['error' => 'User with this email already exists'];
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $this->getToken($user['id']);

        return ['message' => 'User successfully created!', 'access_token' => $token];
    }

    public function isUserExist($email)
    {
        return User::where('email', $email)->first();
    }

    public function getToken(int $id)
    {
        return auth()->tokenById($id);
    }

//    public function getUserData(string $userName)
//    {
//        return User::where('name', $userName)
//            ->with('tasks')
//            ->get();
//    }
}
