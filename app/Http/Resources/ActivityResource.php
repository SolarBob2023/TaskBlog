<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $likedPosts = $this->likedPosts;

//        $data = [];
//       foreach ($userLiked as $like){
//           $data[] = ['post_id' => $like->post_id, 'url' => 'http://127.0.0.1:8000/api/posts/' . str($like->post_id)];
//       }
        dd($likedPosts);
        return [
            'liked_post' => 'sss'
        ];
    }
}
