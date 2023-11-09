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

    public function store(mixed $data)
    {
        Tag::create($data);
    }

    public function update(mixed $data)
    {
        Tag::update($data);
    }

    public function delete(int $id)
    {
        $tag = Tag::find($id);

        $tag->delete($id);
    }
}
