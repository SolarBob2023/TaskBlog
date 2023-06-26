<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DeleteController extends Controller
{
    public function __invoke(Request $request)
    {
        $auth_user = auth()->user();
        $auth_user->delete();
        return response()->json(['message' => 'User was deleted']);
    }
}
