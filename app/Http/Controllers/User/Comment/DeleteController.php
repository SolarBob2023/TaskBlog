<?php

namespace App\Http\Controllers\User\Comment;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Comment;

/**
 *  @OA\Delete(
 *      path="/api/user/comments/{comment}",
 *      summary="Удаление комментария",
 *      tags={"Комментарии"},
 *      security={{ "bearerAuth": {} }},
 *      @OA\Parameter(
 *          description="ID комментария",
 *          in="path",
 *          name="comment",
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
 *                @OA\Property(property="message", type="object", example="Комментарий удалён"),
 *         ),
 *     ),
 *
 * ),
 *
 *
 */


class DeleteController extends Controller
{
    public function __invoke(Comment $comment)
    {
        $userId = auth()->user()->id;
        if ($userId === $comment['user_id']){
            $comment ->delete();
            return response()->json(['message' => 'Комментарий был удалён']);
        } else {
            return response()->json(['message' => 'Вы пытаетесь удалить чужой комментарий']);
        }
    }
}
