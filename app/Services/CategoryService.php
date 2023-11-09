<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepo->all();
    }

    public function withChildren()
    {
        return $this->categoryRepo->withChildren();
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
