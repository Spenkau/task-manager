<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskChildResource extends JsonResource
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
            'category' => [
                'id' => $this['category']->id,
                'name' => $this['category']->name
            ],
            'priority_id' => $this['priority_id'],
            'status_id' => $this['status_id'],
            'parent_id' => $this['parent_id'],
            'started_at' => $this['started_at'],
            'finished_at' => $this['finished_at'],
            'children' => $this['children']->map(function ($child) {
                return new TaskChildResource($child);
            }),
            'tags' => $this['tags']->map(function ($tag) {
                return new TagResource($tag);
            }),
        ];
    }
}