<?php

namespace App\Http\Controllers\User\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'content' => [ 'required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        } else {
            $data = $validator->validated();
            $data['user_id'] = auth()->user()->id;
            $data['post_id'] = $post->id;
            $comment = Comment::firstOrCreate($data);
            return CommentResource::make($comment);
        }
    }
}
