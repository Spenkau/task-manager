<?php

namespace App\Repositories;

use App\Models\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Task;
abstract class BaseRepository
{
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';

    public int $userId;

    protected Model $model;

    public function __construct()
    {
        $this->userId = auth()->user()->id;
    }

    public function allModels()
    {
        return
            $this->model->where('owner_id', $this->userId)->get();
    }

    public function withChildrenModels(array $relations)
    {
        return $this->model::whereNull('parent_id')
            ->where('owner_id', $this->userId)
            ->with($relations)
            ->get();
    }

    public function findModel($id)
    {
        return $this->model->find($id);
    }

    public function storeModel(mixed $data)
    {
        $model = $this->model;

        return $model->create($data);
    }

    public function updateModel(Model $model, mixed $data)
    {
        return $model->update($data);
    }

    public function destroyModel(Model $model)
    {
        return $model->delete();
    }

    public function paginatedModel($paginate)
    {
        return $this->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($paginate);
    }

}
