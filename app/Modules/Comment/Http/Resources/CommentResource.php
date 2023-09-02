<?php

namespace Modules\Comment\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'created by' => $this->user->full_name ,
            'post_id' => $this->post_id,
            'parent' => $this->parent ? $this->parent->id : null,
            $this->mergeWhen(!$this->parent ,[
              'replies' =>  CommentResource::collection($this->replies)
            ]),

         ];
    }
}
