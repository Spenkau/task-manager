<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Get all records from the repository.
     *
     * @return mixed
     */
    public function allModels();

    public function withChildrenModels(array $relations);

    /**
     * Find a record by its ID
     *
     * @param $id
     * @return Model|bool|null
     */
    public function findModel($id);

    /**
     * Create a new record in the repository.
     *
     * @param array $data
     * @return Model|bool|null
     */
    public function storeModel(array $data);

    /**
     * Update fields of selected record.
     *
     * @param Model $model
     * @param array $data
     * @return Model|bool|null
     */
    public function updateModel(Model $model, array $data);

    /**
     * Delete a record from the repository.
     *
     * @param Model $model
     * @return Model|bool|null
     */
    public function destroyModel(Model $model);

}
