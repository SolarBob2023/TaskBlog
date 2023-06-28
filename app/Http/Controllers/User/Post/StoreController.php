<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Post\StoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



/**
 *  @OA\Post(
 *      path="/api/user/posts",
 *      summary="Создание поста",
 *      tags={"Посты"},
 *      security={{ "bearerAuth": {} }},
 *
 *  @OA\RequestBody(
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="title", type="string", example="Sometitle"),
 *                  @OA\Property(property="category_id", type="integer", example=1),
 *                  @OA\Property(property="content", type="string", example="Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex minus, impedit commodi nobis tempore dolores. Cupiditate deserunt temporibus, sunt quia explicabo veritatis assumenda voluptatibus quas, autem ipsa tempora magni aliquam dolorum veniam sapiente expedita recusandae aperiam soluta enim saepe reiciendis odio consequatur dolores omnis. Aliquid excepturi repellat, hic recusandae minima autem enim consectetur fuga maiores quia quidem tempore atque est ea cumque voluptatibus odit veniam ducimus. Expedita omnis molestiae, eos aliquid error saepe nesciunt magnam magni nobis earum, sit nostrum sed possimus dolor eveniet iure eligendi quam corporis cupiditate laboriosam. Molestiae suscipit unde aperiam ducimus ipsa eius voluptate quia? Nesciunt asperiores temporibus voluptates, id voluptatum, ullam accusantium ipsum eveniet totam ut impedit non aut, dolorum corporis hic cum similique exercitationem dolorem consequatur magnam cupiditate officiis. Quidem at architecto sit illum deserunt quas earum cum, fugit laboriosam excepturi similique, quod quasi distinctio, facere minus tempora dolorem! Officia illum quae inventore quidem hic omnis minima voluptate, fugit deleniti assumenda fuga repudiandae possimus, amet nulla, facilis dignissimos. Eveniet culpa neque dolores nulla sunt suscipit, voluptatum laboriosam nam libero, magni omnis ut fuga, consectetur soluta ipsum sequi labore. Dignissimos adipisci autem laborum quo exercitationem, asperiores eum rem sunt eveniet architecto, quae odit? Necessitatibus, a."),
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
 *                @OA\Property(property="title", type="string", example="SomeTitle"),
 *                @OA\Property(property="content", type="string", example="SomeContent"),
 *                @OA\Property(property="category", type="object",
 *                        @OA\Property(property="id", type="integer", example=1),
 *                        @OA\Property(property="title", type="string", example="CategoryTitle"),
 *                    ),
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
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $post = Post::firstOrCreate($data);
        $post->load('category');
        return PostResource::make($post);

    }
}
