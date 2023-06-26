<?php

namespace App\Http\Controllers\User\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class DeleteController extends Controller
{
    public function __invoke(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category was deleted']);
    }
}
