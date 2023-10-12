<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Models\Task;
use http\Env\Request;

class Service
{
    public function show()
    {
        return Category::all();
    }
}
