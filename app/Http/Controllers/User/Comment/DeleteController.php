<?php

namespace App\Http\Controllers\User\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Comment;

class DeleteController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $userId = auth()->user()->id;
        if ($userId === $comment['user_id']){
            $comment ->delete();
            return response()->json(['message' => 'Комментарий был удалён']);
        } else {
            return response()->json(['message' => 'Вы пытаетесь удалить чужой комментарий']);
        }
    }
}
