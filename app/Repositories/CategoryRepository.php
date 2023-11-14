<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected Model $model;

    public function __construct(Category $category)
    {
        parent::__construct();

        $this->model = $category;
    }

    public function all(): Collection
    {
        return $this->allModels();
    }

    public function withChildren(): Collection
    {
        return
            $this->withChildrenModels(['children']);
    }

    public function store(array $data)
    {
        $data['owner_id'] = auth()->user()->id;

        return $this->storeModel($data);
    }

    public function update(array $data)
    {
        $category = $this->findModel($data['id']);

        return $this->updateModel($category, $data);
    }

    public function delete(int $id)
    {
        $category = $this->findModel($id);

        return $this->destroyModel($category);
    }

    public function findOne(string $slug)
    {
        return Category::where('slug', $slug)->pluck('id')->firstOrFail();
    }
}
