<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allOrParent(string $relation)
    {
        if ($relation === 'all') {
            return Category::all();
        }

        return Category::whereParentId(null)
            ->with($relation)
            ->get();
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

    public function findOne(string $slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
}
