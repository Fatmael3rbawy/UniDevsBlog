<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'avatar' => $this->avatar ? asset('storage/' . $this->avatar) : null,
        ];
    }
}
