<?php

namespace App\Http\Controllers\User\Post\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\LikeResource;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $likes = $post->likes;
        return LikeResource::collection($likes);
    }
}
