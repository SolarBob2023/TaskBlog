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

/**
 *  @OA\Post(
 *      path="/api/user/posts/{post}/likes",
 *      summary="Добавление лайка к посту",
 *      tags={"Лайки"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID поста",
 *          in="path",
 *          name="post",
 *          required=true,
 *          example=1
 *      ),
 *
 *
 *
 *     @OA\Response(
 *         response=201,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(property="data", type="object",
 *                @OA\Property(property="id", type="integer", example="1"),
 *                @OA\Property(property="user_id", type="integer", example=1),
 *                @OA\Property(property="post_id", type="integer", example=1),
 *                ),
 *
 *         )
 *
 *
 *     ),
 *
 * ),
 *
 *
 */

class StoreController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $postAuthorId = $post->user->id;
        if ($postAuthorId != auth()->user()->id){
            $data = [];
            $data['user_id'] = auth()->user()->id;
            $data['post_id'] = $post->id;
            $like = Like::firstOrCreate($data);
            return LikeResource::make($like);
        } else {
            return response()->json(['message' => 'Вы пытаетесь лайкнуть свой пост']);
        }

    }
}
