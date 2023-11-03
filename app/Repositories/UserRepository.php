<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function show(string $name)
    {
        return User::whereName($name)->with('tasks')->get();
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
