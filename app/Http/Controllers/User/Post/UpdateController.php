<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => [ 'required', 'string', 'min:6'],
            'content' => [ 'required', 'string', 'min:150'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        } else {
            $data = $validator->validated();
            $data['user_id'] = auth()->user()->id;
            $post->update($data);
            return PostResource::make($post);
        }
    }
}
