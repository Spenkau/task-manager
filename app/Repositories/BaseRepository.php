<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';

    public int $userId;

    protected Model $model;

    public function __construct()
    {
        $this->userId = auth()->user()->id;
    }

    public function allModels(): Collection
    {
        return
            $this->model->where('owner_id', $this->userId)->get();
    }

    public function withChildrenModels(array $relations): Collection
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

    public function storeModel(array $data)
    {
        $model = $this->model;

        return $model->create($data);
    }

    public function updateModel(Model $model, array $data)
    {
        return $model->update($data);
    }

    public function destroyModel(Model $model): Model|bool|null
    {
        return $model->delete();
    }
}
