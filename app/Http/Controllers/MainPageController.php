<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\TaskService;
use Exception;
use Illuminate\Routing\Controller;

class MainPageController extends Controller
{
    protected $categoryService;
    protected $taskService;

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
            return response()->json(['success' => true,
                'data' => [
                    'categories' => $withChildCategories,
                    'allCategories' => $allCategories,
                    'tasks' => $tasks
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to show categories or tasks: ' . $e]);
        }
    }
}
