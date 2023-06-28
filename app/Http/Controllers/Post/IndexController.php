<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('category')->orderBy('created_at', 'DESC')->paginate(10,['*'],'page');

        return PostCollection::make($posts);
    }
}
