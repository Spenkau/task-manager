<?php

namespace App\Repositories;

use App\Http\Filters\TaskFilter;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TaskRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Task $task)
    {
        parent::__construct();

        $this->model = $task;
    }

    public function nested()
    {
        return $this->nestedModels(['children', 'tags', 'category'])
            ->whereNull('finished_at')
            ->paginate(5);
    }

    public function flat(array $data)
    {
        $filter = app()->make(TaskFilter::class, ['queryParams' => array_filter($data)]);

        $query = Task::filter($filter);

        return tap($query, function () {
            $this->flatModels();
        })->paginate(5);
    }

    public function store(array $data)
    {
        $task = $this->storeModel($data['task']);

        if (!empty($data['tags'])) {
            $this->attachTags($data['tags'], $task);
        }

        $task->load(['tags', 'children']);

        return $task;
    }

    public function update(array $data)
    {
        $taskData = $data['task'];

        $task = $this->findModel($taskData['id']);

        $this->updateModel($task, $taskData);

        if ($data['tags']) {
            $this->attachTags($data['tags'], $task);
        }

        $task->load(['children', 'tags']);

        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();

        $task->children()->delete();
    }

    public function show(int $taskId)
    {
        return $this->findModel($taskId);
    }

    public function showByCategory($categoryId)
    {
        $query = Task::where('category_id', $categoryId);

        return $this->applyRequest($query);
    }

    public function manageStatus(array $data)
    {
        $task = Task::find($data['id']);

        if ($data['finished_at']) {
            $task->finished_at = $data['finished_at'];
        }

        $this->changeStatusValue($task, $data['status_id']);

        return $task;
    }

    public function attachTags(array $tags, $task)
    {
        $task->tags()->syncWithoutDetaching($tags);
    }

    public function changeStatusValue($task, $status_id)
    {
        $task->status_id = $status_id;

        $task->save();

        $task->refresh();
    }

    public function applyRequest(Builder $builder)
    {
        return $builder->ownerId($this->userId)
            ->paginate(5);
    }
}
