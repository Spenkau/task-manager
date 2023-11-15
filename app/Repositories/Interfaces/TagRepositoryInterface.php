<?php

namespace App\Repositories\Interfaces;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;

interface TagRepositoryInterface
{
    public function index();

    public function store(array $data);

    public function update(array $data);

    public function delete(int $id);
}
