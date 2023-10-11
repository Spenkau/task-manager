<?php

namespace App\Http\Controllers\Task;

use App\Models\Task;
use App\Http\Controllers\BaseController;
use http\Env\Request;

class FilteredTasksController extends BaseController
{
    public function getTasksByCategory(Request $request)
    {
        $tasks = $this->service->tasksBySlug($request);


    }
}
