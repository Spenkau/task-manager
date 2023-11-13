<?php

namespace App\Http\Controllers;

use App\Events\Task\TaskCreateEvent;
use App\Events\Task\TaskDeleteEvent;
use App\Events\Task\TaskStatusUpdateEvent;
use App\Events\Task\TaskUpdateEvent;
use App\Http\Requests\Task\FilterRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Task;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(FilterRequest $request): JsonResponse|AnonymousResourceCollection
    {
        $data = $request->validated();

        $tasks = TaskResource::collection($this->taskService->all($data));

        try {
            return $tasks;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e], 500);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['owner_id'] = auth()->user()->id;

        try {
            $newTask = $this->taskService->store($data);

            broadcast(new TaskCreateEvent($newTask))->toOthers();

            return response()->json(['message' => 'Task successfully stored!', 'data' => $newTask]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        broadcast(new TaskUpdateEvent($data))->toOthers();

        try {
            $task = $this->taskService->update($data);
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

    public function show(Task $task): JsonResponse|TaskResource
    {
        $task = new TaskResource($this->taskService->show($task->id));

        try {
            return $task;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your task: ' . $e], 500);
        }
    }

    public function showByCategory(string $slug): JsonResponse|AnonymousResourceCollection
    {
        $tasks = TaskResource::collection($this->taskService->showByCategory($slug));

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
            $task = $this->taskService->manageStatus($data);

            broadcast(new TaskStatusUpdateEvent($task))->toOthers();

            return response()->json(['message' => 'Task status changed!', 'task' => $task]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to complete task:' . $e], 500);
        }
    }
}
