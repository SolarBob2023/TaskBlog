<?php

namespace App\Http\Controllers\User\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }
}
