<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
interface UserRepositoryInterface
{
    public function getAllUsers();
    public function create(mixed $data);
//    public function getUserData(string $userName);
}
