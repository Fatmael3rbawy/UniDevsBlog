<?php

namespace Modules\Post\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Comment\Http\Resources\CommentResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => intval($this->id),
            'title' => $this->title,
            'content' => $this->content,
            'created by' => $this->user->full_name ,
            'photo' => $this->photo ? asset('storage/' . $this->photo) : null,
            'comments' => $this->comments ? CommentResource::collection($this->comments) : null,
        ];
    }
}
