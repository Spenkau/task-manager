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
            return Task::paginate(5);
        }

        return Task::whereNull('parent_id')
            ->with(['children', 'tags'])
            ->where('owner_id', $userId)
            ->paginate(5);
    }

    public function show(int $taskId)
    {
        return Task::find($taskId);
    }

    public function showByCategory($categoryId)
    {
        return Task::where('category_id', $categoryId)
            ->get();
    }

    public function store(mixed $data)
    {
        return Task::create($data);
    }

    public function update(mixed $data)
    {
        $task = Task::find($data['id']);

        $task->update($data);
    }

    public function delete(Task $task)
    {
        $task->delete();
    }

    public function finish(mixed $data)
    {
        $task = Task::find($data['id']);

        $task->finished_at = $data['finished_at'];
        $task->status_id = StatusEnum::FINISHED;

        $task->save();
    }

    public function getByCategory(Task $task)
    {
        return Task::with('category')->where('category_id', $task->category_id)->toArray();
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
