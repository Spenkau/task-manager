<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Category;
use App\Models\Task;
use App\Services\CategoryService;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->allOrParent('children');

        try {
            return view('pages.main', ['categories' => $categories]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to show categories: ' . $e]);
        }
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $this->categoryService->store($data);
            return back();
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update: ' . $e]);
        }
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        try {
            $this->categoryService->update($category, $data);
            return redirect()->route('categories');
        } catch (Exception $e) {
            return redirect()->route('categories')->with(['error' => 'Failed to update categories: ' . $e]);
        }
    }

    public function softDelete(Category $category)
    {
        try {
            $this->categoryService->softDelete($category);
            Session::flash('message', 'Task deleted successfully');
        } catch (NotFoundHttpException $e) {
            Session::flash('message', $e->getMessage());
        }

        return back();
    }
}
