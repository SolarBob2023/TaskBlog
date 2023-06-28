<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;


/**
 *  @OA\Delete(
 *      path="/api/user/posts/{post}",
 *      summary="Удаление поста",
 *      tags={"Посты"},
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
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(property="message", type="object", example="Пост был удалён"),
 *         ),
 *
 *
 *     ),
 *
 * ),
 *
 *
 */

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
