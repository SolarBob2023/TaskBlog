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

Route::get('/', function () {
    return response()->json(['message' => 'Авторизируйтесь по адресу http://127.0.0.1:8000/api/auth/login']);
})->name('login');
Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me']);

});

Route::group(['prefix' => 'user'], function () {
    //Создание пользователя
    Route::post('/register',\App\Http\Controllers\User\StoreController::class);
    //Изменение данных пользователя
    Route::post('/change',\App\Http\Controllers\User\UpdateController::class)->middleware('jwt.auth');
    //Удаление пользователя
    Route::post('/delete',\App\Http\Controllers\User\DeleteController::class)->middleware('jwt.auth');

    //Категории
    Route::group(['prefix' => 'categories', 'middleware' => 'jwt.auth'], function (){
        Route::post('/', \App\Http\Controllers\User\Category\StoreController::class);
        Route::delete('/{category}', \App\Http\Controllers\User\Category\DeleteController::class);
    });

    // посты
    Route::group(['prefix' => 'posts', 'middleware' => 'jwt.auth'], function (){
        Route::post('/', \App\Http\Controllers\User\Post\StoreController::class);
        Route::patch('/{post}', \App\Http\Controllers\User\Post\UpdateController::class);
        Route::delete('/{post}', \App\Http\Controllers\User\Post\DeleteController::class);

        // комментарии
        Route::post('/{post}/comments', \App\Http\Controllers\User\Post\Comment\StoreController::class);

        // лайки
        Route::post('/{post}/likes', \App\Http\Controllers\User\Post\Like\StoreController::class);


    });

    Route::group(['prefix' => 'comments', 'middleware' => 'jwt.auth'], function (){
        //Удаление комметария
        Route::delete('/{comment}', \App\Http\Controllers\User\Comment\DeleteController::class);
        //Редактирование комментария
        Route::patch('/{comment}', \App\Http\Controllers\User\Comment\UpdateController::class);
    });

    Route::group(['prefix' => 'likes', 'middleware' => 'jwt.auth'], function (){
        //Удаление лайков
        Route::delete('/{like}', \App\Http\Controllers\User\Like\DeleteController::class);
    });

    //Аквтиновсть пользователя
    Route::get('/myactivity', \App\Http\Controllers\User\ActivityController::class)->middleware('jwt.auth');;

});

//Просмотр выбранного комментрия
Route::get('/comments/{comment}', \App\Http\Controllers\Comment\ShowController::class);

//Категории
Route::get('categories/', \App\Http\Controllers\Category\IndexController::class);
Route::get('categories/{category}', \App\Http\Controllers\Category\ShowController::class);

//Посты
Route::get('/posts/', \App\Http\Controllers\Post\IndexController::class);
Route::get('/posts/{post}', \App\Http\Controllers\Post\ShowController::class);
//просомтр коментариев и лайков у поста
Route::get('/posts/{post}/comments', \App\Http\Controllers\Post\Comment\IndexController::class);
Route::get('/posts/{post}/likes', \App\Http\Controllers\Post\Like\IndexController::class);
