<?php

namespace App\Http\Controllers\User\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Post\Comment\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Comment $comment)
    {
        $authId = auth()->user()->id;
        $data = $request->validated();
        if ($authId == $comment['user_id']){
            $comment->update($data);
            return CommentResource::make($comment);
        } else {
            return response()->json(['message' => 'Вы пытаетесь редактировать чужой комментарий']);
        }


    }
}
