<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = false;

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('childrenCategories');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
