<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;


/**
 *  @OA\Get(
 *      path="/api/user/myactivity",
 *      summary="Просмотр понравившихся постов",
 *      tags={"Активность"},
 *      security={{ "bearerAuth": {} }},
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
class ActivityController extends Controller
{
    public function __invoke()
    {
        $likedPosts = auth()->user()->likedPosts()->with('comments', 'category', 'user')->get();;
        foreach ($likedPosts as $post){
            $post->user->setHidden(['login']);
            $post->comments->setHidden(['id','post_id']);
            foreach ($post->comments as $comment){
                $comment->user->setHidden(['login']);
            }
            $post->makeHidden(['content']);
            $post->setVisible(['url']);
        }
        return PostResource::collection($likedPosts);
    }
}
