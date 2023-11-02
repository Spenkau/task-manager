<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{

    public function getAllUsers()
    {
        return User::all();
    }

//    public function getUserData(string $userName)
//    {
//        return User::where('name', $userName)
//            ->with('tasks')
//            ->get();
//    }
}
