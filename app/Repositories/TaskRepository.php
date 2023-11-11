<?php

namespace App\Repositories;

use App\Enums\RelationEnum;
use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TaskRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Task $task)
    {
        parent::__construct();

        $this->model = $task;
    }

    public function all()
    {
            return $this->allModels();

    }

    public function withChildren()
    {
        return Task::whereNull('parent_id')
            ->with('tags')
            ->where('owner_id', $this->user)
            ->paginate(5);
    }

    public function store(array $data)
    {

        // TODO сделать разделение массивов
        $task = $this->storeModel($data['task']);

//        if ($data['tags']) {
//            $this->attachTags($data['tags'], $task);
//        }

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
        return $this->findModel($taskId);
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
