<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

interface TagRepositoryInterface
{
    public function index();
    public function showTasks(array $tags);
}
