<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

/**
 *  @OA\Get(
 *      path="/api/categories",
 *      summary="Список категорий",
 *      tags={"Категории"},
 *
 *
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(property="data", type="array", @OA\Items(
 *                @OA\Property(property="id", type="integer", example="1"),
 *                @OA\Property(property="title", type="string", example="SomeTitle"),
 *                @OA\Property(property="posts_count", type="integer", example=20),
 *                ),
 *             ),
 *         )
 *
 *
 *     ),
 *
 * ),
 *
 *
 */

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $categories->loadCount('posts');
        return CategoryResource::collection($categories);
    }
}
