<?php

namespace App\Models;

//use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
