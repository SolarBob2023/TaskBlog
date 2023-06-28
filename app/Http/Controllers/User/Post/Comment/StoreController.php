<?php

namespace App\Http\Controllers\User\Post\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Post\Comment\StoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;


/**
 *  @OA\Post(
 *      path="/api/user/posts/{post}/comments",
 *      summary="Добавление комментария к посту",
 *      tags={"Комментарии"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID поста",
 *          in="path",
 *          name="post",
 *          required=true,
 *          example=1
 *      ),
 *
 *  @OA\RequestBody(
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="content", type="string", example="Good"),
 *
 *              )
 *          }
 *     )
 *
 *  ),
 *
 *
 *     @OA\Response(
 *         response=201,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(property="data", type="object",
 *                @OA\Property(property="id", type="integer", example="1"),
 *                @OA\Property(property="post_id", type="integer", example=1),
 *                @OA\Property(property="content", type="string", example="Content"),
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
    public function __invoke(StoreRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post->id;
        $comment = Comment::firstOrCreate($data);
        return CommentResource::make($comment);

    }
}
