<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use App\Models\Task;

interface CategoryRepositoryInterface
{
    public function all();

    public function withChildren();

    public function store(mixed $data);

    public function update(mixed $data);

    public function delete(int $id);
}
