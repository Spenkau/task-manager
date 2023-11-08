<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function allOrParent(string $relation)
    {
//        return CategoryResource::collection($this->categoryRepo->allOrParent($relation));
        return $this->categoryRepo->allOrParent($relation);
    }

    public function store(mixed $data)
    {
        return $this->categoryRepo->store($data);
    }

    public function update(mixed $data)
    {
        return $this->categoryRepo->update($data);
    }


    public function delete(int $id)
    {
        return $this->categoryRepo->delete($id);
    }
}
