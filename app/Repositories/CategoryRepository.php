<?php

namespace App\Repositories;

use App\Enums\RelationEnum;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository
{
    protected Model $model;

    public function __construct(Category $category)
    {
        parent::__construct();

        $this->model = $category;
    }

    public function all()
    {
        return $this->allModels();
    }

    public function withChildren()
    {
        return $this->withChildrenModels(['children']);
    }

    public function store(mixed $data)
    {
        $category = Category::where('name', $data['name']);

        if ($category) {
            return ['message' => 'Category already exist!'];
        }

        $this->storeModel($data);

        return ['message' => 'Category created'];
    }

    public function update(mixed $data)
    {
        $category = $this->findModel($data['id']);

        if ($category) {
            $this->updateModel($category, $data);

            return ['message' => 'Category updated!'];
        }

        return ['message' => 'Something went wrong!'];
    }

    public function delete(int $id)
    {
        $category = $this->findModel($id);

        if ($category) {
            $this->destroyModel($category);

            return ['message' => 'Category deleted!'];
        }

        return ['message' => 'Something went wrong!'];
    }

    public function findOne(string $slug)
    {
        return Category::where('slug', $slug)->pluck('id')->firstOrFail();
    }
}
