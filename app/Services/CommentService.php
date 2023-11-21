<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use App\Repositories\CommentRepository;

class CommentService
{
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepository = $commentRepo;
    }

    public function store(array $data)
    {
        return $this->commentRepository->store($data);
    }

    public function update(array $data)
    {
        return $this->commentRepository->update($data);
    }

    public function delete(int $id)
    {
        return $this->commentRepository->delete($id);
    }

}
