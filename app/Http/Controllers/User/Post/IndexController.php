<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('category')->orderBy('created_at', 'DESC')->paginate(10)->all();
        foreach ($posts as $post){
            $post->makeHidden(['content']);
            $post->loadCount('comments');
        }
        return PostResource::collection($posts);
    }
}
