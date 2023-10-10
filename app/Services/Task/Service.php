<?php

namespace App\Services\Task;

use App\Models\Task;

class Service
{
    public function store($data)
    {
        Task::create($data);

    }

    public function update($post, $data)
    {
        $post->update($data);
    }
}
