<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
interface TaskRepositoryInterface
{
    public function all();
    public function getByUser(Task $task);
    public function getByCategory(Task $task);
}
