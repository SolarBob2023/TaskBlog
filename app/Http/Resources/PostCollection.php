<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'data';

    public function toArray(Request $request): array
    {
        $posts = $this->all();
        foreach ($posts as $post){
            $post->makeHidden(['content']);
            $post->loadCount('comments');
            $post->loadCount('likes');
        }

        return ['posts' => $posts ];
    }
}
