<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = UserResource::make($this->whenLoaded('user'));
        $category = CategoryResource::make($this->whenLoaded('category'));
        $comments = CommentResource::collection($this->whenLoaded('comments'));
        $hiddenElements = $this->getHidden();
        $resource = [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->when(!in_array('content',$hiddenElements),
                $this->content,
                mb_substr($this->content,0,100),
            ),
            'category' => $category,
            'user' => $user,
            'comments' => $comments,
            'comments_count' => $this->whenCounted('comments'),
            'likes_count' => $this->whenCounted('likes'),
            'url' => $this->when(in_array('url',$this->getVisible() ),
                                 'http://127.0.0.1:8000/api/posts/' . str($this->id)
                                ),
        ];

        return $resource;
    }

}
