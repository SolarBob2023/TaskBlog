<?php

namespace App\Http\Controllers\User\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;

class DeleteController extends Controller
{
    public function __invoke(Like $like)
    {
        $userId = auth()->user()->id;
        if ($userId === $like['user_id']){
            $like ->delete();
            return response()->json(['message' => 'Лайк был удалён']);
        } else {
            return response()->json(['message' => 'Вы пытаетесь удалить чужой лайк']);
        }
    }
}
