<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Exception;
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

//        $data = TaskResource::collection($tasks);

        try {
            return response()->view('tasks', ['tasks' => $tasks]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e]);
        }
    }

    public function show(Task $task)
    {
        $task = $this->taskService->show($task->id);

        try {
            return response()->view('task', ['task' => $task]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e]);
        }
    }

    public function showByCategory(Request $request)
    {
        $tasks = $this->taskService->showByCategory('red');

        dump($tasks);

        try {
            return response()->view('tasks', ['tasks' => $tasks]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e]);
        }
    }

    public function store(StoreRequest $request)
    {
        $data = TaskDTO::formRequest($request);

        try {
            $this->taskService->store($data);
            return redirect()->route('tasks');
        } catch (Exception $e) {
            return redirect()->route('tasks')->with(['error' => 'Failed to store task:' . $e]);
        }
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        try {
            $this->taskService->update($task, $data);
            return redirect()->route('tasks');
        } catch (Exception $e) {
            return redirect()->route('tasks')->with(['error' => 'Failed to update task: ' . $e]);
        }
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
}
