<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public $sortBy = 'created_at';
    public $sortOrder = 'asc';

    public function all(string $relation)
    {
        if ($relation === 'all' | $relation === '') {
            return $this->model->all();
        }

        return $this->model->orderBy($this->sortBy, $this->sortOrder)
            ->with($relation)
            ->get();
    }

    public function paginated($paginate)
    {
        return $this
            ->model
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($paginate);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $field, mixed $data)
    {
        $model = $this->model;

        $model->firstOrCreate($field, $data);
//        return $model;
    }

    public function update(Model $model, mixed $data)
    {
        $model->update($data);
//        return $model;
    }

    public function destroy(Model $model)
    {
        return $model->delete();
    }
}
