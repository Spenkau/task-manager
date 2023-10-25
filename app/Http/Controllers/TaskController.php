<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Http\Requests\Tag\StoreTagRequest;
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
        $tasks = $this->taskService->allOrParent('children');

        try {
            return response()->json(['tasks' => $tasks], 418);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e], 500);
        }
    }

    public function show(Task $task)
    {
        $task = $this->model->firstOrCreate(['a' => 'b']);

        return $task;
//        $task = $this->taskService->show($task->id);
//
//        try {
//            return response()->json(['tasks' => $task]);
//        } catch (Exception $e) {
//            return response()->json(['error' => 'Failed to show your task: ' . $e]);
//        }
    }

    public function showByCategory()
    {
        $tasks = $this->taskService->showByCategory('purple');

        dump($tasks);
        try {
            return response()->json(['tasks' => $tasks]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your task: ' . $e], 500);
        }
    }

    // TODO реализация store временная. Позже добавлять настоящий user_id и сделать правильный редирект
    public function store(StoreRequest $taskRequest, StoreTagRequest $tagRequest)
    {
        $data = $taskRequest->validated();
        $data['user_id'] = 1;

        $tags = $tagRequest->input('tags');

        dump($tags);

        try {
            $this->taskService->store($data);
            return response()->json(['message' => 'Task successfully stored!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        try {
            $this->taskService->update($task, $data);
            return response()->json(['message' => 'Task successfully updated!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function softDelete(Task $task)
    {
        try {
            $this->taskService->softDelete($task);
            return response()->json(['message' => 'Task successfully deleted!']);
        } catch (NotFoundHttpException $e) {
            return response()->json(['error' => 'Failed to delete task: ' . $e], 500);
        }
    }
}
