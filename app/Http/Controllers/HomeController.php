<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except("tokenRegister");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // controller.php
        return $this->redirectAsRole();
    }
    public function tokenRegister()
    {
        $this->validate(request(), [
            "token" => "required"
        ]);
        try {
            $user  = request()->user();
            $user->fcm_token = request("token");
            $user->save();
        } catch (\Throwable $th) {
            report($th);
            return response()->json([
                "message"   => "failed."
            ],422);
        }
        return response()->json([
            "message" => "token updated successfully."
        ],200);
    }

}
