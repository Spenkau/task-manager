<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
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
        $categories = $this->categoryService->allOrParent('children');

        return view('main', compact('categories'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        if ($category->id <= 4) {
            throw new \Exception('Нельзя изменять первые четыре значения');
        }

        $data = $request->validated();

        $this->categoryService->update($category->id, $data);

        return back();
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->categoryService->store($data);

        return back();
    }

    public function delete(Category $category)
    {
        if ($category->id <= 4) {
            throw new \Exception('Нельзя изменять первые четыре значения');
        }

        $this->categoryService->delete($category->id);

        return back();
    }

}
