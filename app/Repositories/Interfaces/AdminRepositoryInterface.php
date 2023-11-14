<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
interface AdminRepositoryInterface
{
    public function getUsers();
    public function getCategories();
    public function getTags();
}
