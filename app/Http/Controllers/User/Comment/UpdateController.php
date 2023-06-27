<?php

namespace App\Http\Controllers\User\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(), [
            'content' => [ 'required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        } else {
            $authId = auth()->user()->id;
            $data = $validator->validated();
            if ($authId == $comment['user_id']){
                $comment->update($data);
                return CommentResource::make($comment);
            } else {
                return response()->json(['message' => 'Вы пытаетесь редактировать чужой комментарий']);
            }

        }
    }
}
