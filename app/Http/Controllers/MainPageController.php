<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\TaskService;
use Exception;

class MainPageController extends Controller
{
    protected CategoryService $categoryService;
    protected TaskService $taskService;

    public function __construct(CategoryService $categoryService, TaskService $taskService)
    {
        $this->categoryService = $categoryService;
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->allOrParent('children');

        $withChildCategories = $this->categoryService->allOrParent('children');
        $allCategories = $this->categoryService->allOrParent('all');

        try {
            return response()->view('filtered_tasks', ['success' => true,
                'data' => [
                    'categories' => $withChildCategories,
                    'allCategories' => $allCategories,
                    'tasks' => $tasks
                ]
            ]);
        } catch (Exception $e) {
            return response()->view('filtered_tasks', ['success' => false, 'error' => 'Failed to show categories or tasks: ' . $e]);
        }
    }
}
