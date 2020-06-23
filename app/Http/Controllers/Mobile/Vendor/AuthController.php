<?php

namespace App\Http\Controllers\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), Vendor::lognRules());
        if ($validator->fails()) {
            return response()
                ->json([
                    "message" => "Validation error",
                    "status"  => false,
                    "data"    => $validator->errors(),
                ]);
        }
        $vendor               = Vendor::inRandomOrder()->first();
        $token                = $vendor->createToken('token-name');
        $vendor->access_token = $token->plainTextToken;
        return response()
            ->json([
                "data"    => $vendor,
                "message" => "Successfully logged in.",
                "status"  => true,
            ]);

    }
}
