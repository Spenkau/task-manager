<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;
use http\Env\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskService
{
    protected $taskRepo;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepo = $taskRepository;
    }

    public function allOrParent(string $relation)
    {
        return $this->taskRepo->allOrParent($relation);
    }

    public function show(int $taskId)
    {
        try {
            $task = $this->taskRepo->show($taskId);
            return response()->json(['success' => true, 'data' => $task]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failted tot show task: ' . $e]);
        }
    }

    public function showByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->first();

        $tasks = $this->taskRepo->showByCategory($category->id);

        try {
            return response()->json(['success' => true, 'data' => $tasks]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to show tasks: ' . $e]);
        }
    }

    public function store(mixed $data)
    {
        try {
            $this->taskRepo->store($data);
            return response()->json(['success' => true, 'message' => 'Task created']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create: ' . $e]);
        }
    }

    public function softDelete(Task $task)
    {
        try {
            $this->taskRepo->softDelete($task);
            return response()->json(['success' => false, 'message' => 'Task deleted']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create: ' . $e]);
        }

    }
}
