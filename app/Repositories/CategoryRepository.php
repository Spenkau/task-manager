<?php

namespace App\Repositories;

use App\Enums\RelationEnum;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function withChildren()
    {
        return Category::whereNull('parent_id')
            ->with('children')
            ->get();
    }

    public function store(mixed $data)
    {
        $category = Category::where('name', $data['name']);

        if ($category) {
            return ['message' => 'Category already exist!'];
        }

        Category::create($data);

        return ['message' => 'Category created'];
    }

    public function update(mixed $data)
    {
        $category = Category::find($data['id']);

        if ($category) {
            $category->update($data);

            return ['message' => 'Category updated!'];
        }

        return ['message' => 'Something went wrong!'];
    }

    public function delete(int $id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();

            return ['message' => 'Category deleted!'];
        }

        return ['message' => 'Something went wrong!'];
    }

    public function findOne(string $slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
}
