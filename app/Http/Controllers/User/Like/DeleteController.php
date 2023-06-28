<?php

namespace App\Http\Controllers\User\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;

/**
 *  @OA\Delete(
 *      path="/api/user/likes/{like}",
 *      summary="Удаление лайка",
 *      tags={"Лайки"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID лайка",
 *          in="path",
 *          name="like",
 *          required=true,
 *          example=1
 *      ),
 *
 *
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(property="message", type="object", example="Лайк был удалён"),
 *         ),
 *     ),
 *
 * ),
 *
 *
 */

class DeleteController extends Controller
{
    public function __invoke(Like $like)
    {
        $userId = auth()->user()->id;
        if ($userId === $like['user_id']){
            $like ->delete();
            return response()->json(['message' => 'Лайк был удалён']);
        } else {
            return response()->json(['message' => 'Вы пытаетесь удалить чужой лайк']);
        }
    }
}
