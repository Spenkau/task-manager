<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->commentService->store($data);
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $this->commentService->update($data);
    }

    public function delete(Comment $comment)
    {
        $this->commentService->delete($comment->id);
    }
}
