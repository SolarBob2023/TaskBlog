<?php

namespace App\Http\Controllers\User\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'title' => [ 'required', 'string', 'unique:categories'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        } else {
            $data = $validator->validated();
            $category->update($data);
            return CategoryResource::make($category);
        }
    }
}
