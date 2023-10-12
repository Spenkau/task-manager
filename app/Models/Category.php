<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $table = 'categories';
    protected $guarded = false;

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function tasks()
    {
//        Category::query()->where(...)?->categories;
        return $this->hasMany(Task::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
