<?php

namespace App\Http\Resources;

use App\Enums\PriorityEnum;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'title' => $this['title'],
            'content' => $this['content'],
            'category_id' => $this['category_id'],
            'priority_id' => $this['priority_id'],
            'status_id' => $this['status_id'],
            'parent_id' => $this['parent_id'],
            'started_at' => $this['started_at'],
            'finished_at' => $this['finished_at'],
            'tags' => count($this->tags) > 0 ? $this->tags->map(function ($tag) {
                return new TagResource($tag);
            }) : [],
        ];
    }
}
