<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Post\UpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($post->user_id == auth()->user()->id) {
            $data['user_id'] = auth()->user()->id;
            $post->update($data);
            $post->load('category');
            return PostResource::make($post);
        } else {
            return response()->json(['message' => 'Ошибка - вы пытаетесь редактировать чужой пост']);
        }


    }
}
