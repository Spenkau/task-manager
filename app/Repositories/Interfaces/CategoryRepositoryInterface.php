<?php

namespace App\Repositories\Interfaces;
use App\Models\Category;
use App\Models\Task;

interface CategoryRepositoryInterface
{
    public function allOrParent(string $relation);
    public function store(mixed $data);

    public function update(Category $category, $data);

    public function delete(Category $category);
}
