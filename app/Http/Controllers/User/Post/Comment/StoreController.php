<?php

namespace App\Http\Controllers\User\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Post\Comment\StoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;
        $comment = Comment::firstOrCreate($data);
        return CommentResource::make($comment);

    }
}
