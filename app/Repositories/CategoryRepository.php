<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Task;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allOrParent(string $relation)
    {
        return Category::whereParentId(null)->with($relation)->get()->toArray();
    }

    public function store(mixed $data)
    {
        Category::firstOrCreate(['name' => $data['name']], $data);
    }

    public function update(Category $category, $data)
    {
        $category->update($data);
    }

    public function softDelete(Category $category)
    {
        $category->delete();
    }
}
