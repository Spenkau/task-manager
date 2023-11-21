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
        $data['user_id'] = $this->userId;

        return $this->storeModel($data);
    }

    public function update(array $data)
    {
        $comment = $this->findModel($data['id']);

        return $this->updateModel($comment, $data);
    }

    public function delete(int $id)
    {
        $comment = $this->findModel($id);

        return $this->destroyModel($comment);
    }
}
