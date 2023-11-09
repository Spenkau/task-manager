<?php

namespace App\Http\Controllers;

use App\DTO\TaskDTO;
use App\Events\Task\TaskCreateEvent;
use App\Events\Task\TaskDeleteEvent;
use App\Events\Task\TaskStatusUpdateEvent;
use App\Events\Task\TaskUpdateEvent;
use App\Http\Requests\Task\FinishRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskResourceCollection;
use App\Models\Task;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\Request;
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
        $user = Auth::user();

        $tasks = TaskResource::collection($this->taskService->allOrParent('children', $user['id']));

        try {
            return response()->json($tasks);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show your tasks: ' . $e], 500);
        }
    }

    public function show(Task $task)
    {
        $task = new TaskResource($this->taskService->show($task->id));

        try {
            return response()->json(['data' => $task]);
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

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $newTask = $this->taskService->store($data);

            broadcast(new TaskCreateEvent($newTask))->toOthers();

            return response()->json(['message' => 'Task successfully stored!', 'data' => $newTask]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        broadcast(new TaskUpdateEvent($data))->toOthers();

        try {
            $task = $this->taskService->update($data);
            return response()->json(['message' => 'Task successfully updated!', 'data' => $task]);
        } catch (Exception $e) {
            if ($data->fails()) {
                return response()->json(['errors' => $data->errors()], 422);
            }
            return response()->json(['error' => 'Failed to store your task: ' . $e], 500);
        }
    }

    public function delete(Task $task)
    {

        broadcast(new TaskDeleteEvent($task))->toOthers();

        try {
            $this->taskService->delete($task);
            return response()->json(['message' => 'Task successfully deleted!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete task: ' . $e], 500);
        }
    }

    // TODO делать ли отдельный контроллер для завершения \ отложения задачи, оставлять ли связь мени ту мени для таски-юзеры

    public function manageStatus(Request $request)
    {
        $data = $request->all();

        try {
            $task = $this->taskService->manageStatus($data);

            broadcast(new TaskStatusUpdateEvent($task))->toOthers();

            return response()->json(['message' => 'Task completed!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to complete task:' . $e]);
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
