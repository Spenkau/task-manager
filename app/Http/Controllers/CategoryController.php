<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function show()
    {   //
        $categories = Category::with('children')->where('category_id', null)->get();

        return view('main', compact('categories'));
    }
}
