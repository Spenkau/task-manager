<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function index()
    {
        return User::all();
    }

    public function create(mixed $data)
    {
        User::firstOrCreate(['email' => $data['email']], $data);
    }

    public function update(mixed $data)
    {

    }
}
