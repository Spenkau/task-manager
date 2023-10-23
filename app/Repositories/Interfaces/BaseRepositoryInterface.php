<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    /**
     * Get all records from the repository.
     *
     * @return mixed
     */
    public function all();

    /**
     * Assign pagination to the selected model.
     *
     * @param $paginate
     * @return mixed
     */
    public function paginated($paginate);

    /**
     * Create a new record in the repository.
     *
     * @param $input
     * @return mixed
     */
    public function create($input);

    /**
     * Find a record by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find($id);

    /**
     * Delete a record from the repository.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * Update fields of selected record.
     *
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input);
}
