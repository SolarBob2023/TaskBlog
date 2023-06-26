<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => [ 'required', 'string', 'unique:users', 'min:6'],
            'name'=> [ 'required', 'string', 'min:3'],
            'surname' => [ 'required', 'string', 'min:3'],
            'email' => [ 'required', 'string', 'email', 'unique:users'],
            'password' => [ 'required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ]);
        } else {
            $data = $validator->validated();
            $data['password'] = Hash::make($data['password']);
            User::firstOrCreate(['email' => $data['email'], 'login' => $data['login']], $data);
            return response()->json(['message' => 'User successfully created']);
        }
    }
}
