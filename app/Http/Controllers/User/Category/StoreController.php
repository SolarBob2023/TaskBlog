<?php

namespace App\Http\Controllers\User\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 *  @OA\Post(
 *      path="/api/user/categories",
 *      summary="Создать категорию",
 *      tags={"Категории"},
 *      security={{ "bearerAuth": {} }},
 *
 *     @OA\RequestBody(
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="title", type="string", example="Спорт"),
 *              )
 *          }
 *     )
 *
 *  ),
 *
 *
 *
 *     @OA\Response(
 *         response=201,
 *         description="Ok",
 *         @OA\JsonContent(
 *            @OA\Property(property="data", type="object",
 *
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="title", type="string", example="Спорт"),
 *            )
 *         )
 *
 *
 *     ),
 *
 * ),
 *
 **/
class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        $category = Category::firstOrCreate(['title' => $data['title']], $data);
        return CategoryResource::make($category);

    }
}
