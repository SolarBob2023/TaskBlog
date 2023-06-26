<?php

namespace App\Http\Controllers\User\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function __invoke(Request $request)
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
            Category::firstOrCreate(['title' => $data['title']], $data);
            return response()->json(['message' => 'Category successfully created']);
        }
    }
}
