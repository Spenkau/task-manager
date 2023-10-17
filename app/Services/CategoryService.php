<?php

namespace App\Services;

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
        return $this->categoryRepo->allOrParent($relation);
    }

    public function update(Category $category, $data)
    {
        $this->categoryRepo->update($category, $data);
    }

    public function store(mixed $data)
    {
        $this->categoryRepo->store($data);
    }

    public function softDelete(Category $category)
    {
        $this->categoryRepo->softDelete($category);
    }
}
