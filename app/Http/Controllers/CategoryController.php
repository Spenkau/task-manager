<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $allCategories = CategoryResource::collection($this->categoryService->allOrParent('all'));

        try {
            return response()->json(['data' => $allCategories]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show categories: ' . $e], 500);
        }
    }

    public function withChildren()
    {
        $withChildCategories = CategoryResource::collection($this->categoryService->allOrParent('children'));

        try {
            return response()->json(['data' => $withChildCategories]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show categories: ' . $e], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $response = $this->categoryService->store($data);
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to store category: ' . $e], 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();

        try {
            $response = $this->categoryService->update($data);
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update category: ' . $e], 500);
        }
    }

    public function delete(int $id)
    {
        try {
            $response = $this->categoryService->delete($id);
            return response()->json($response);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete category: ' . $e], 500);
        }
    }
}
