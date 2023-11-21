<?php


namespace App\Http\Filters;


use App\Models\Category;
use App\Models\Tag;
use App\Models\Task;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const CATEGORY_ID = 'category_id';
    public const PRIORITY_ID = 'priority_id';
    public const STATUS_ID = 'status_id';
//    public const TAGS_ID = 'tags_id';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::PRIORITY_ID => [$this, 'priorityId'],
            self::STATUS_ID => [$this, 'statusId'],
//            self::TAGS_ID => [$this, 'tagsId'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }

    public function priorityId(Builder $builder, $value)
    {
        $builder->where('priority_id', $value);
    }

    public function statusId(Builder $builder, $value)
    {
        $builder->where('status_id', $value);
    }

//    public function tagsId(Builder $builder, $value)
//    {
//        return Task::whereHas('tags', function ($query) use ($value) {
//            $query->whereIn('tag_id', $value);
//        });
//    }
}
