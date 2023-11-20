<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CommentRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Comment $comment)
    {
        parent::__construct();

        $this->model = $comment;
    }

    public function store(array $data)
    {

    }

    public function update(array $data)
    {

    }

    public function delete(int $id)
    {

    }
}
