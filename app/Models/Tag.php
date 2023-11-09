<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name'];

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tag) {
            $tag->tasks()->detach();
        });
    }
}
