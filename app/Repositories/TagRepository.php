<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\User;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function index()
    {
        return Tag::all();
    }
}
