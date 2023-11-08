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

    public function create(mixed $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }


//    public function getUserData(string $userName)
//    {
//        return User::where('name', $userName)
//            ->with('tasks')
//            ->get();
//    }
}
