<?php


namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function show()
    {
        $categories = [];


        return view('main', compact('categories'));
    }
}
