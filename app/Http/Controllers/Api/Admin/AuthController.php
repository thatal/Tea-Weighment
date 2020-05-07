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
    public function logout()
    {
        \Log::info(Auth::getDefaultDriver());
        Auth::guard("web")->logout();
        try {
            return response()
                ->json([
                    "status"    => true,
                    "message"   => "logged out successfully."
                ]);
        } catch (\Throwable $th) {
            \Log::error($th);
            return response()
                ->json([
                    "status"    => false,
                    "message"   => "action failed."
                ], 401);
        }
    }
}
