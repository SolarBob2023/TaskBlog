<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class ActivityController extends Controller
{
    public function __invoke()
    {
        $likedPosts = auth()->user()->likedPosts()->with('comments', 'category', 'user')->get();;
        foreach ($likedPosts as $post){
            $post->user->setHidden(['login']);
            $post->comments->setHidden(['id','post_id']);
            foreach ($post->comments as $comment){
                $comment->user->setHidden(['login']);
            }
            $post->makeHidden(['content']);
            $post->setVisible(['url']);
        }
        return PostResource::collection($likedPosts);
    }
}
