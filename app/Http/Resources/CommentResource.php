<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = UserResource::make($this->whenLoaded('user'));
        $hiddenElements = $this->getHidden();
        return [
            'id' => $this->when(!in_array('id',$hiddenElements),
                $this->id),
            'post_id' => $this->when(!in_array('post_id',$hiddenElements),
                $this->post_id),
            'content' => $this->content,
            'user' => $user,
         ];
    }
}
