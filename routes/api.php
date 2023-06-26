<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me']);

});

Route::group(['prefix' => 'user'], function () {
    Route::post('/',\App\Http\Controllers\User\StoreController::class);
    Route::post('/change',\App\Http\Controllers\User\UpdateController::class)->middleware('jwt.auth');
    Route::post('/delete',\App\Http\Controllers\User\DeleteController::class)->middleware('jwt.auth');

    Route::group(['prefix' => 'categories', 'middleware' => 'jwt.auth'], function (){
        Route::get('/', \App\Http\Controllers\User\Category\IndexController::class);
        Route::get('/{category}', \App\Http\Controllers\User\Category\ShowController::class);
        Route::post('/', \App\Http\Controllers\User\Category\StoreController::class);
        Route::patch('/{category}', \App\Http\Controllers\User\Category\UpdateController::class);
        Route::delete('/{category}', \App\Http\Controllers\User\Category\DeleteController::class);
    });

    Route::group(['prefix' => 'posts', 'middleware' => 'jwt.auth'], function (){
        Route::get('/', \App\Http\Controllers\User\Post\IndexController::class);
        Route::get('/{post}', \App\Http\Controllers\User\Post\ShowController::class);
        Route::post('/', \App\Http\Controllers\User\Post\StoreController::class);
        Route::patch('/{post}', \App\Http\Controllers\User\Post\UpdateController::class);
        Route::delete('/{post}', \App\Http\Controllers\User\Post\DeleteController::class);
    });




});
