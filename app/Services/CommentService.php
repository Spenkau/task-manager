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
        $this->commentRepository->store($data);
    }

    public function update(array $data)
    {
        $this->commentRepository->update($data);
    }

    public function delete(int $id)
    {
        $this->commentRepository->delete($id);
    }

}
