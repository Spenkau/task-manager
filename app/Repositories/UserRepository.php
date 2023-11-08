<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function show(string $email)
    {
        return User::whereEmail($email)->with('tasks')->first();
    }

    public function store(mixed $data)
    {
        $user = $this->isUserExist($data['email']);

        if ($user) {
            return ['message' => 'User with this email already exists'];
        }
        User::firstOrCreate([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $this->getToken($data['id']);

        return ['message' => 'User successfully created!', 'access_token' => $token];
    }

    public function isUserExist($data)
    {
        return User::where('email', $data)->first();
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
