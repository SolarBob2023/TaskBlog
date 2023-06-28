<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

/**
 *  @OA\Get(
 *      path="/api/posts/{post}",
 *      summary="Просмотр поста",
 *      tags={"Посты"},
 *
 *     @OA\Parameter(
 *          description="id поста",
 *          in="path",
 *          name="post",
 *          required=false,
 *          example=1
 *      ),
 *
 *
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(property="data", type="object",
 *
 *
 *                @OA\Property(property="id", type="integer", example="1"),
 *                @OA\Property(property="title", type="string", example="SomeTitle"),
 *                @OA\Property(property="content", type="string", example="SomeContent"),
 *                @OA\Property(property="category", type="object",
 *                        @OA\Property(property="id", type="integer", example=1),
 *                        @OA\Property(property="title", type="string", example="category"),
 *                ),
 *                @OA\Property(property="user", type="object",
 *                        @OA\Property(property="id", type="integer", example=1),
 *                        @OA\Property(property="name", type="string", example="robert"),
 *                        @OA\Property(property="surname", type="string", example="lapko"),
 *                ),
 *                @OA\Property(property="comments", type="array", @OA\Items(
 *                        @OA\Property(property="user", type="object",
 *                               @OA\Property(property="id", type="integer", example=1),
 *                               @OA\Property(property="name", type="string", example="robert"),
 *                               @OA\Property(property="surname", type="string", example="lapko"),
 *                        ),
 *                        @OA\Property(property="content", type="string", example="content"),
 *                      ),
 *                ),
 *
 *            )
 *         )
 *
 *
 *     ),
 *
 * ),
 *
 **/


class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->load('user','comments','category');
        $post->user->setHidden(['login']);
        $post->comments->setHidden(['id','post_id']);
        foreach ($post->comments as $comment){
            $comment->user->setHidden(['login']);
        }
        $post->setHidden(['category_id']);
        return PostResource::make($post);
    }
}
