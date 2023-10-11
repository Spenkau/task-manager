<?php

namespace App\Services\Task;

use App\Models\Category;
use App\Models\Task;
use http\Env\Request;

class Service
{
    public function showAll()
    {
        return Task::with(['category', 'user'])->get();
    }

    public function store($data)
    {
        Task::create($data);
    }

    public function update($task, $data)
    {
        $task->update($data);
    }

    public function tasksBySlug(Request $request)
    {
        $categorySlug = $request->getQuery('category');

        $categoryId = Category::where('slug', $categorySlug)->value('id');

        return Task::where('category_id', $categoryId)->get();
    }
}
