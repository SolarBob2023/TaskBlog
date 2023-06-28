<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class DeleteController extends Controller
{
    public function __invoke(Post $post)
    {
        if ($post->user_id == auth()->user()->id){
            $post->comments()->delete();
            $post->likes()->delete();
            $post->delete();
            return response()->json(['message' => 'Пост был удалён']);
        } else {
            return response()->json(['message' => 'Ошибка вы пытаетесь удалить чужой пост']);
        }

    }
}
