<?php

namespace App\Repositories;

use App\Enums\RelationEnum;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function allOrParent(string $relation)
    {
        if ($relation == RelationEnum::ALL) {
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

    public function delete(Category $category)
    {
        $category->delete();
    }

    public function findOne(string $slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
}
