<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';

    public int $userId;

    protected Model $model;

    public function __construct()
    {
        $user = auth()->user();

        if (!$user) {
            throw new UnauthorizedHttpException('Unauthorized');
        }

        $this->userId = $user->id;
    }

    public function flatModels()
    {
        return
            $this->model->where('owner_id', $this->userId);
    }

    public function nestedModels(array $relations): Builder
    {
        return $this->model::whereNull('parent_id')
            ->where('owner_id', $this->userId)
            ->with($relations);
    }

    public function findModel($id)
    {
        return $this->model->find($id);
    }

    public function storeModel(array $data)
    {
        $model = $this->model;

        $data['owner_id'] = $this->userId;

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

    public function ownerId(Builder $builder)
    {
        return $builder->where('owner_id', $this->userId);
    }
}
