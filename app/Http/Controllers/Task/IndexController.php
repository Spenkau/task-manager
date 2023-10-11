<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Services\Task\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;
use App\Enums\StatusEnum;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $tasks = $this->service->showAll();

        return view('tasks', compact('tasks'));
    }
}
