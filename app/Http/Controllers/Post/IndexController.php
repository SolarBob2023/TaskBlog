<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;

/**
 *  @OA\Get(
 *      path="/api/posts?page={page}",
 *      summary="Список постов",
 *      tags={"Посты"},
 *
 *     @OA\Parameter(
 *          description="номер страницы",
 *          in="path",
 *          name="page",
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
 *                @OA\Property(property="posts", type="array", @OA\Items(
 *                @OA\Property(property="id", type="integer", example="1"),
 *                @OA\Property(property="title", type="string", example="SomeTitle"),
 *                @OA\Property(property="content", type="string", example="SomeContent"),
 *                @OA\Property(property="category", type="object",
 *                        @OA\Property(property="id", type="integer", example=1),
 *                        @OA\Property(property="title", type="string", example=""),
 *                    ),
 *                @OA\Property(property="comments_count", type="integer", example=10),
 *                @OA\Property(property="likes_count", type="string", example=5),
 *                )),
 *            )
 *         )
 *
 *
 *     ),
 *
 * ),
 *
 **/

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('category')->orderBy('created_at', 'DESC')->paginate(10,['*'],'page');

        return PostCollection::make($posts);
    }
}
