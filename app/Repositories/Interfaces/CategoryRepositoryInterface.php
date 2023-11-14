<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    public function all();

    public function withChildren();

    public function store(array $data);

    public function update(array $data);

    public function delete(int $id);

    public function findOne(string $slug);
}
