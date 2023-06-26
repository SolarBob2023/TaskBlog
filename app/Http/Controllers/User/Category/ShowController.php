<?php

namespace App\Http\Controllers\User\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class ShowController extends Controller
{
    public function __invoke(Category $category)
    {
        return CategoryResource::make($category);
    }
}
