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

    public function show()
    {
        return Category::all();
    }

    public function store($data)
    {
        return $this->categoryRepo->store($data);
    }
}
