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

//    public function index()
//    {
//        $withChildCategories = $this->categoryService->allOrParent('children');
//        $allCategories = $this->categoryService->allOrParent('all');
//
//        try {
//            return view('pages.main', ['categories' => $withChildCategories, 'allCategories' => $allCategories]);
//        } catch (Exception $e) {
//            return response()->json(['error' => 'Failed to show categories: ' . $e]);
//        }
//    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
//            dump((new CategoryDTO($data))->name);
            $this->categoryService->store($data);
            return response()->json(['success' => true, 'message' => 'Category successfully stored!']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to store category: ' . $e]);
        }
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        try {
            $this->categoryService->update($category, $data);
            return response()->json(['success' => true, 'message' => 'Category successfully stored!']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to update category: ' . $e]);
        }
    }

    public function delete(Category $category)
    {
        try {
            $this->categoryService->delete($category);
            return response()->json(['success' => true, 'message' => 'Category successfully deleted!']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to delete category: ' . $e]);
        }
    }
}
