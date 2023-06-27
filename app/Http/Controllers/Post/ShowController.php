<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->load('user','comments','category');
        $post->user->setHidden(['login']);
        $post->comments->setHidden(['id','post_id']);
        foreach ($post->comments as $comment){
            $comment->user->setHidden(['login']);
        }

        $post->setHidden(['category_id']);
        return PostResource::make($post);
    }
}
