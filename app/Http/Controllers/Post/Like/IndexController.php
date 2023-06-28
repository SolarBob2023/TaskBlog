<?php

namespace App\Http\Controllers\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $likes = $post->likes;
        return LikeResource::collection($likes);
    }
}
