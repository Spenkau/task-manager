<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function show()
    {
        $categories = Category::with('children')->whereNull('category_id')->get()->toArray();

        dump($categories);
        return view('main', compact('categories'));
    }
}
