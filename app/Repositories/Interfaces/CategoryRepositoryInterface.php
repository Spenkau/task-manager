<?php

namespace App\Repositories\Interfaces;
use App\Models\Task;
interface CategoryRepositoryInterface
{
    public function allOrParent(string $relation);
    public function store(mixed $data);

    public function update(int $categoryId, $data);

    public function delete(int $categoryId);
}
