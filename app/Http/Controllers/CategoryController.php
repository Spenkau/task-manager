<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function show()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        $array = $categories->toArray();

        dump($array);
        return view('main', compact('categories'));
    }
}
