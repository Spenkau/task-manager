<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(mixed $data)
    {
        User::firstOrCreate([
            'name' => $data['name']
        ], [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserData(string $userName)
    {
        return User::where('name', $userName)
            ->with('tasks')
            ->get();
    }
}
