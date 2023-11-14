<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository implements AdminRepositoryInterface
{

    public function getUsers(): Collection
    {
        return User::all();
    }

    public function getCategories(): Collection
    {
        return Category::all();
    }

    public function getTags(): Collection
    {
        return Tag::all();
    }

    public function getComments(): Collection
    {
        return Comment::all();
    }
}
