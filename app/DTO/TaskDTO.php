<?php

namespace App\DTO;

use App\Enums;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class TaskDTO
{
    public string $title;
    public string $content;
    public int $category_id;
    public int $priority_id;
    public int $status_id;
    public int $user_id;
    public int $parent_id;
    public mixed $started_at;
    public mixed $finished_at;
//    public Tag $tags;
//    public User $user;

    public function __construct($args)
    {
        $this->title = $args['title'];
        $this->content = $args['content'];
        $this->category_id = $args['category_id'];
        $this->priority_id = $args['priority_id'];
        $this->status_id = $args['status_id'];
        $this->user_id = $args['user_id'];
        $this->parent_id = $args['parent_id'];
        $this->started_at = $args['started_at'];
        $this->finished_at = $args['finished_at'];
//        $this->tags = $args['tags'];
//        $this->user = $args['user'];
    }
}
