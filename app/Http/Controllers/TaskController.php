<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends BaseController
{
    public function index()
    {
        $tasks = $this->service->showAll();

        return view('tasks', compact('tasks'));
    }

    public function show(Task $task)
    {
        dump($task);
    }

    public function store(StoreRequest $request, Task $task)
    {
        $data = $request->validated();

        $this->service->store($data);
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        $this->service->update($task, $data);

        return redirect()->route('post.show', $task->id);
    }

    public function showByCategory(\http\Env\Request $request)
    {
        $tasks = $this->service->tasksBySlug($request);
    }
}
