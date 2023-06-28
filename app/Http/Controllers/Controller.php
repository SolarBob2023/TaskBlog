<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 *
 * @OA\Info(
 *      title = "My Doc Api",
 *      version = "1.0.0"
 * ),
 * @OA\PathItem(
 *      path = "/api/"
 * )
 *
 * @OA\Components(
 *     @OA\SecurityScheme(
 *         securityScheme="bearerAuth",
 *         type="http",
 *         scheme="bearer"
 *     )
 * )
 *
 *  @OA\Post(
 *      path="/api/auth/login",
 *      summary="Авторизация",
 *      tags={"Auth"},
 *
 *  @OA\RequestBody(
 *      @OA\JsonContent(
 *          allOf={
 *              @OA\Schema(
 *                  @OA\Property(property="email", type="string", example="wlehner@example.net"),
 *                  @OA\Property(property="password", type="string", example="12345678"),
 *              )
 *          }
 *     )
 *
 *  ),
 *
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1d"),
 *                @OA\Property(property="token_type", type="string", example="bearer"),
 *                @OA\Property(property="expires_in", type="integer", example=20),
 *            )
 *
 *
 *     ),
 *
 * ),
 *
 *  @OA\Post(
 *      path="/api/auth/me",
 *      summary="Информация о пользователе",
 *      tags={"Auth"},
 *      security={{ "bearerAuth": {} }},
 *
 *
 *
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(property="login", type="string", example="Eloise"),
 *                @OA\Property(property="name", type="string", example="Clementina"),
 *                @OA\Property(property="surname", type="string", example="Cassin"),
 *            )
 *
 *
 *     ),
 *
 * ),
 *  @OA\Post(
 *      path="/api/auth/logout",
 *      summary="Выйти из системы",
 *      tags={"Auth"},
 *      security={{ "bearerAuth": {} }},
 *
 *
 *
 *
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *                @OA\Property(property="message", type="string", example="Successfully logged out"),
 *            )
 *
 *
 *     ),
 *
 * ),
 *
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}


