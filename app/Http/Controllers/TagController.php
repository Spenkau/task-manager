<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreRequest;
use App\Http\Requests\Tag\UpdateRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Services\TagService;
use App\Services\TaskService;
use Exception;

class TagController extends Controller
{
    public TagService $tagService;
    public TaskService $taskService;

    public function __construct(TagService $tagService, TaskService $taskService)
    {
        $this->tagService = $tagService;
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tags = TagResource::collection($this->tagService->index());

        try {
            return response($tags);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show tags: ' . $e]);
        }
    }

    public function store(StoreRequest $request)
    {
        $tag = $request->validated();


        try {
            Tag::create($tag);
//            $this->taskService->store($tag);

            return response()->json(['message' => 'Tag created!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store tag: ' . $e]);
        }
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        try {
            $this->taskService->update($data);

            return response()->json(['message' => 'Tag updated!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update tag: ' . $e]);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->tagService->delete($id);

            return response()->json(['message' => 'Tag deleted!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete tag: ' . $e], 500);
        }
    }

//    public function showTasks($tags)
//    {
//        $tasks = $this->tagService->showTasksByTags($tags);
//
//        return response()->view('filtered_tasks')
//    }
//    public function showByTags(Tag $tag)
//    {
//        try {
//            $tasks = $this->taskService->showByTags($tag);
//            return response()->view('filtered_tasks', ['tasks' => $tasks]);
//        } catch (Exception $e) {
//            return back()->with(['error' => 'Failed to show your tasks: ' . $e]);
//        }
//    }
}
