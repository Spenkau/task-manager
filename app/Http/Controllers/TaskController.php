<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->allOrParent('children');

        dump($tasks);
        return view('tasks', compact('tasks'));
    }

    public function show(Task $task)
    {
        $task = $this->taskService->show($task->id);
        dump($task);
        return view('task', compact('task'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->taskService->store($data);

        return 'таска создана!';
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        $this->taskService->update($task, $data);

        return redirect()->route('post.show', $task->id);
    }

    public function showByCategory(\http\Env\Request $request)
    {
        $tasks = $this->taskService->tasksBySlug($request);
    }
}
