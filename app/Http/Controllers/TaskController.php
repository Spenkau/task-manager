<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Services\Task\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;
use App\Enums\StatusEnum;

class TaskController extends BaseController
{
    public function show()
    {
        $tasks = $this->service->show();

        return view('tasks', compact('tasks'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        dump($data);
    }

    public function update(UpdateRequest $request, Task $task)
    {
        $data = $request->validated();

        $this->service->update($task, $data);
    }
}
