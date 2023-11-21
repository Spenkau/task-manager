<?php

namespace App\Http\Controllers;

use App\Events\Comment\CommentCreateEvent;
use App\Events\Comment\CommentDeleteEvent;
use App\Events\Comment\CommentUpdateEvent;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Exception;

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

        $comment = new CommentResource($this->commentService->store($data));

        try {
            broadcast(new CommentCreateEvent($comment))->toOthers();

            return $comment;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store your comment: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        $newComment = new CommentResource($this->commentService->update($data));

        try {
            broadcast(new CommentUpdateEvent($newComment))->toOthers();
            return $newComment;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update your comment: ' . $e], 500);
        }
    }

    public function delete(Comment $comment)
    {
        try {
            broadcast(new CommentDeleteEvent($comment));
            return $this->commentService->delete($comment->id);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete your comment: ' . $e], 500);
        }
    }
}
