<?php

namespace App\Http\Controllers;

use App\Services\TagService;
use App\Services\TaskService;
use Exception;
use Illuminate\Routing\Controller;

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
        $tags = $this->tagService->index();

        $tasks = $this->tagService->showAllTasks();

        try {
            return response()->json(['data' => ['tags' => $tags, 'tasks' => $tasks]], 500);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show tags: ' . $e]);
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
