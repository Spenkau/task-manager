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

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request, Task $task)
    {
        $data = $request->validated();

        $this->service->store($data);
    }
}
