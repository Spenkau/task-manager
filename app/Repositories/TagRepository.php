<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function index()
    {
        return Tag::all();
    }

    public function showTasks(array $tags)
    {

        if (!empty($tags)) {
            $tags = Tag::find($tags);
            return $tags->tasks();
        }

        return Tag::all();
    }
}
