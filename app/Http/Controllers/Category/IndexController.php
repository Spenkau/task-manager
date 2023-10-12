<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Category;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();

        $array = $categories->toArray();
        dump($array);
        return view('welcome', compact('categories'));
    }

}
