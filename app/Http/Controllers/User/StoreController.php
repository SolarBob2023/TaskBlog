<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 *  @OA\Post(
 *      path="/api/user/register",
 *      summary="Регистрация",
 *      tags={"Auth"},
 *
 *  @OA\RequestBody(
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="login", type="string", example="solrbob"),
 *                  @OA\Property(property="name", type="string", example="robert"),
 *                  @OA\Property(property="surname", type="string", example="lapko"),
 *                  @OA\Property(property="email", type="string", example="admin@admin.com"),
 *                  @OA\Property(property="password", type="string", example="12345678"),
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
 *            @OA\Property(property="data", type="object",
 *                @OA\Property(property="id", type="integer", example="1"),
 *                @OA\Property(property="login", type="string", example="solrbob"),
 *                @OA\Property(property="name", type="string", example="robert"),
 *                @OA\Property(property="surname", type="string", example="lapko"),
 *
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

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::firstOrCreate(['email' => $data['email'], 'login' => $data['login']], $data);
        return UserResource::make($user);
    }
}
