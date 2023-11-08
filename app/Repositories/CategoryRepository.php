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
        $category = Category::where('id', $data['id']);

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

    // TODO закончить реализацию метода получения задач по слагу категорий
    // перенести в TaskRepo скорее
    public function findOne(string $slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
}
