<?php

namespace App\Models;

use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    public $timestamps = false;
    protected $fillable = ['name', 'slug'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
