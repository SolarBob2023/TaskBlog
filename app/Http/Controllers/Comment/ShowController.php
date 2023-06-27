<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class ShowController extends Controller
{
    public function __invoke(Comment $comment)
    {
        return CommentResource::make($comment);
    }
}
