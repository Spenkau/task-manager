<?php


namespace App\Http\Filters;


use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const PRIORITY_ID = 'priority_id';
    public const STATUS_ID = 'status_id';
    public const TAG_IDS = 'tag_ids';

    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::PRIORITY_ID => [$this, 'priorityId'],
            self::STATUS_ID => [$this, 'statusId'],
            self::TAG_IDS => [$this, 'tagIds'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function priorityId(Builder $builder, $value)
    {
        $builder->where('priority_id', $value);
    }

    public function statusId(Builder $builder, $value)
    {
        $builder->where('status_id', $value);
    }

    public function tagIds(Builder $builder, $value)
    {
        $builder->where('tag_ids', $value);
    }
}
