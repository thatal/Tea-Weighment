<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            "email" => "required|email",
            "password"  => "required"
        ];
        $this->validate($request, $rules);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                "message"   => "Login success",
                "status"    => true,
                "data"      => auth()->user()
            ]);
        }else{
            return response()->json([
                "message"   => "Login failed",
                "status"    => false,
                "data"      => []
            ], 401);
        }
    }
}
