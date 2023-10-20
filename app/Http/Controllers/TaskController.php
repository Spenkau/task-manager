<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
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
        $tasks = $this->taskService->allOrParent('all');

        try {
            return response()->view('tasks', ['tasks' => $tasks]);
        } catch (Exception $e) {
            return response()->view('tasks', ['error' => 'Failed to show your tasks: ' . $e]);
        }
    }

    public function show(Task $task)
    {
        $task = $this->taskService->show($task->id);

        try {
            return response()->view('task', ['task' => $task]);
        } catch (Exception $e) {
            return response()->view('task', ['error' => 'Failed to show your tasks: ' . $e]);
        }
    }

    public function showByCategory()
    {
        $tasks = $this->taskService->showByCategory('purple');

        dump($tasks);
        return response()->view('filtered_tasks', ['tasks' => $tasks]);
//        return view('tasksBySlug');
//        try {
//            return response()->view('filtered_tasks', ['tasks' => $tasks]);
//        } catch (Exception $e) {
//            return back()->with(['error' => 'Failed to show your tasks: ' . $e]);
//        }
    }

    public function showByTags(Tag $tag)
    {
        try {
            $tasks = $this->taskService->showByTags($tag);
            return response()->view('filtered_tasks', ['tasks' => $tasks]);
        } catch (Exception $e) {
            return back()->with(['error' => 'Failed to show your tasks: ' . $e]);
        }
    }

    // TODO реализация store временная. Позже добавлять настоящий user_id и сделать правильный редирект
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = 1;

        try {
            $this->taskService->store($data);
            return back()->with(['success' => true, 'message' => 'Task successfully created!']);
        } catch (Exception $e) {
            return back()->with(['success' => false, 'error' => 'Failed to store data: ' . $e]);
        }
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        try {
            $this->taskService->update($task, $data);
            return back()->with(['success' => true, 'message' => 'Task successfully updated!']);
        } catch (Exception $e) {
            return back()->with(['error' => 'Failed to update task: ' . $e]);
        }
    }

    public function softDelete(Task $task)
    {
        try {
            $this->taskService->softDelete($task);
            return back()->with(['success' => true, 'message' => 'Task successfully deleted!']);
        } catch (NotFoundHttpException $e) {
            return back()->with(['error' => 'Failed to delete task: ' . $e]);
//            Session::flash('message', $e->getMessage());
        }
    }
}
