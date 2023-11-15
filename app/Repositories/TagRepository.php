<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    protected Model $model;

    public function __construct(Tag $tag)
    {
        parent::__construct();

        $this->model = $tag;
    }

    public function index(): Collection
    {
        return $this->allModels();
    }

    public function store(array $data)
    {
        $data['owner_id'] = $this->userId;

        return $this->storeModel($data);
    }

    public function update(array $data)
    {
        $tag = $this->findModel($data['id']);

        $this->updateModel($tag, $data);
    }

    public function delete(int $id)
    {
        $tag = $this->findModel($id);

        $this->destroyModel($tag);
    }
}
