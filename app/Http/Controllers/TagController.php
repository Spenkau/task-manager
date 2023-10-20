<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TagController extends Controller
{
    public TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $tags = $this->tagService->index();

        return response()->view('filtered_tasks', ['tags' => $tags]);
    }

    public function tasksByTags(string $selectedTags)
    {
        $tasks = $this->tagService->showTasks($selectedTags);

        return response()->view('filtered_tasks', ['tasks' => $tasks]);
    }
}
