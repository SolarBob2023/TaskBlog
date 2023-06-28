<?php

namespace App\Http\Controllers\User\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class DeleteController extends Controller
{
    public function __invoke(Category $category)
    {
        $category->loadCount('posts');
        if ($category->posts_count == 0){
            $category->delete();
            return response()->json(['message' => 'Категория была удалена']);
        } else {
            return response()->json(['message' => 'Ошибка - в базе даных есть посты с данной категорией']);
        }

    }
}
