<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
