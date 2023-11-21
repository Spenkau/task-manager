<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
use App\Models\User;

interface UserRepositoryInterface
{
    public function store(mixed $data);
//    public function getUserData(string $userName);
}
