<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        return response()->view('task', ['task' => $task]);
    }

    public function showByCategory(string $slug)
    {
        $tasks = $this->taskService->showByCategory($slug);

        dump($slug);

        return view('tasks_by_category', compact('tasks', 'slug'));
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

    public function softDelete(Task $task)
    {
        try {
            $this->taskService->softDelete($task);
            Session::flash('message', 'Task deleted successfully');
        } catch (NotFoundHttpException $e) {
            Session::flash('message', $e->getMessage());
        }

        return back();
    }

//    public function showByCategory(\http\Env\Request $request)
//    {
//        $tasks = $this->taskService->tasksBySlug($request);
//    }
}
