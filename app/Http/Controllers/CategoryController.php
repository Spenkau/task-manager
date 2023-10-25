<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $withChildCategories = $this->categoryService->allOrParent('children');
        $allCategories = $this->categoryService->allOrParent('all');

        try {
            return response()->json(['data' => [
                'with_children' => $withChildCategories,
                'all_categories' => $allCategories
            ]]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show categories: ' . $e], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
//            dump((new CategoryDTO($data))->name);
            $this->categoryService->store($data);
            return response()->json(['message' => 'Category successfully stored!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store category: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        try {
            $this->categoryService->update($category, $data);
            return response()->json(['message' => 'Category successfully stored!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update category: ' . $e], 500);
        }
    }

    public function delete(Category $category)
    {
        try {
            $this->categoryService->delete($category);
            return response()->json(['message' => 'Category successfully deleted!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete category: ' . $e], 500);
        }
    }
}
