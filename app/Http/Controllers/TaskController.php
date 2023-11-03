<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Events\Task\TaskCreateEvent;
use App\Events\Task\TaskDeleteEvent;
use App\Events\Task\TaskUpdateEvent;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Task;
use App\Services\TaskService;
use Exception;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = TaskResource::collection($this->taskService->allOrParent('children'));
//        $tasks = new TaskResourceCollection($this->taskService->allOrParent('children'));
        try {
            return $tasks;
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e], 500);
        }
    }

    public function show(Task $task)
    {
        $task = new TaskResource($this->taskService->show($task->id));

        try {
            return response()->json(['tasks' => $task]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your task: ' . $e]);
        }
    }

    public function showByCategory(string $slug)
    {
        $tasks = TaskResource::collection($this->taskService->showByCategory($slug));

        try {
            return response()->json(['tasks' => $tasks]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your task: ' . $e], 500);
        }
    }

    // todo добавлять настоящий user_id
    public function store(StoreRequest $taskRequest)
    {
        $data = $taskRequest->validated();

        try {
            $this->taskService->store($data);

//            TaskCreateEvent::dispatch($data);
//            broadcast(new TaskCreateEvent($data))->toOthers();

            return response()->json(['message' => 'Task successfully stored!', 'data' => $data   ]);
        } catch (Exception $e) {
            if ($data->fails()) {
                return response()->json(['errors' => $data->errors()], 422);
            }
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        broadcast(new TaskUpdateEvent($data))->toOthers();

        try {
            $this->taskService->update($task, $data);
            return response()->json(['message' => 'Task successfully updated!']);
        } catch (Exception $e) {
            if ($data->fails()) {
                return response()->json(['errors' => $data->errors()], 422);
            }
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function softDelete(Task $task)
    {

        broadcast(new TaskDeleteEvent($task))->toOthers();

        try {
            $this->taskService->softDelete($task);
            return response()->json(['message' => 'Task successfully deleted!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete task: ' . $e], 500);
        }
    }

    public function filterTasks()
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters('title')
            ->get();

        return response()->json(['res' => '111']);
    }
}
