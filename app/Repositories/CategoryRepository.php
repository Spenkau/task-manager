<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Task;

class CategoryRepository
{
    public function all()
    {
        return Category::all();
    }

    public function store($data)
    {
        return Category::create($data);
    }
//    public function update($taskId, $data)
//    {
//        $task = Task::find
//    }
}
