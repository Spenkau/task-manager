<?php

namespace App\Repositories;

use App\Enums\RelationEnum;
use App\Enums\StatusEnum;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\DTO\TaskDTO;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class TaskRepository implements TaskRepositoryInterface
{
    public function allOrParent(string $relation, int $userId)
    {
        if ($relation == RelationEnum::ALL) {
            return Task::where('owner_id', $userId)->paginate(5);
        }

        return Task::whereNull('parent_id')
            ->with('tags')
            ->where('owner_id', $userId)
            ->paginate(5);
    }

    public function store(array $data)
    {
        // TODO сделать разделение массивов

        $task = Task::create($data);

        if ($data['tags']) {
            $this->attachTags($data['tags'], $task);
        }

        $task->load(['children', 'tags']);

        return $task;
    }

    public function update(array $data)
    {
        $task = Task::find($data['id']);

        $task->update($data);

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

//        $children = Task::where('parent_id', $task['id'])->get();


    }

    public function show(int $taskId)
    {
        return Task::find($taskId)->with('tags');
    }

    public function showByCategory($categoryId)
    {
        return Task::where('category_id', $categoryId)
            ->with('tags')
            ->get();
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

//    public function filterTasks(string $field)
//    {
//        $tasks = QueryBuilder::for(Task::class)
//            ->allowedFilters($field)
//            ->get();
//
//        return $tasks;
//    }
}
