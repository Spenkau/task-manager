<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $tasks = $this->service->showAll();

        return view('tasks', compact('tasks'));
    }
}
