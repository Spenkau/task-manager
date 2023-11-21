<?php

namespace App\Http\Controllers;

use App\Events\Task\TaskCreateEvent;
use App\Events\Task\TaskDeleteEvent;
use App\Events\Task\TaskStatusUpdateEvent;
use App\Events\Task\TaskUpdateEvent;
use App\Http\Requests\Task\FilterRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskChildResource;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Mail\TaskReminder;
use App\Models\Task;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function nested()
    {
        $tasks = TaskChildResource::collection($this->taskService->nested());

        try {
            return $tasks;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e], 500);
        }
    }

    public function flat(FilterRequest $request)
    {
        $data = $request->validated();

        $tasks = TaskResource::collection($this->taskService->flat($data));

        try {
            return $tasks;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e], 500);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $task = new TaskResource($this->taskService->store($data));

//            Mail::to('kholyavskij@mail.ru')->send(new TaskReminder($newTask));

            broadcast(new TaskCreateEvent($task))->toOthers();

            return response()->json(['message' => 'Task successfully stored!', 'data' => $task]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $task = new TaskResource($this->taskService->update($data));

            broadcast(new TaskUpdateEvent($task))->toOthers();

            return response()->json(['message' => 'Task successfully updated!', 'data' => $task]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function delete(Task $task): JsonResponse
    {
        broadcast(new TaskDeleteEvent($task))->toOthers();

        try {
            $this->taskService->delete($task);
            return response()->json(['message' => 'Task successfully deleted!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete task: ' . $e], 500);
        }
    }

    public function show(Task $task): JsonResponse
    {
        $task = $this->taskService->show($task->id);

        try {
            return response()->json($task);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your task: ' . $e], 500);
        }
    }

    public function showByCategory(string $slug): JsonResponse|AnonymousResourceCollection
    {
        $tasks = TaskChildResource::collection($this->taskService->showByCategory($slug));

        try {
            return $tasks;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your task: ' . $e], 500);
        }
    }

    public function manageStatus(Request $request): JsonResponse
    {
        $data = $request->all();

        try {
            $task = new TaskResource($this->taskService->manageStatus($data));

            broadcast(new TaskStatusUpdateEvent($task))->toOthers();

            return response()->json(['message' => 'Task status changed!', 'task' => $task]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to complete task:' . $e], 500);
        }
    }
}
