<?php

namespace App\Http\Controllers\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke(Post $post)
    {
        $comments = $post->comments;
        return CommentResource::collection($comments);
    }
}
