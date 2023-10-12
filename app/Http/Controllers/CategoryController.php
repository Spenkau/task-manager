<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function showCategories()
    {
        $categories = Category::all();

        return view('main', compact('categories'));
    }

    public function storeCategory(StoreRequest $request)
    {
        $data = $request->validated();

        $this->categoryService->store($data);
    }

}
