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
//        $category = Category::where('name', $data['name']);

//        if (isset($category->id)) {
//            return ['message' => 'Category already exist!'];
//        }

        $data['owner_id'] = auth()->user()->id;
        $response = $this->storeModel($data);

        if ($data['parent_id'] === null) {
            unset($data['parent_id']);
        }

        return ['message' => 'Category created', 'data' => $response];
    }

    public function update(mixed $data)
    {
        $category = $this->findModel($data['id']);

        if ($category) {
            $response = $this->updateModel($category, $data);

            return ['message' => 'Category updated!', 'data' => $response];
        }

        return ['message' => 'Something went wrong!'];
    }

    public function delete(int $id)
    {
        $category = $this->findModel($id);

        if ($category) {
            $response = $this->destroyModel($category);

            return ['message' => 'Category deleted!', $response];
        }

        return ['message' => 'Something went wrong!'];
    }

    public function findOne(string $slug)
    {
        return Category::where('slug', $slug)->pluck('id')->firstOrFail();
    }
}
