<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use App\Services\TaskService;
use Illuminate\Http\Request;
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

        dump($tasks);
        return response()->view('filtered_tasks', ['tags' => $tags, 'tasks' => $tasks]);
    }

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
