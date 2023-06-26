<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> [ 'required', 'string', 'min:3'],
            'surname' => [ 'required', 'string', 'min:3'],
            'password' => [ 'required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        } else {

            $auth_user = auth()->user();
            $data = $validator->validated();
            $data['password'] = Hash::make($data['password']);
            $auth_user->update($data);
            return response()->json(['message' => 'User successfully changed']);
        }
    }
}
