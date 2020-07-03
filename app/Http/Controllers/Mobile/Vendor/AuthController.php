<?php

namespace App\Http\Controllers\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\Vendor;
use Hash;
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

        if ($request->get("role") === "factory") {
            $factory = Factory::where('username', $request->username)->first();
            if (!$factory || !Hash::check($request->password, $factory->password)) {
                return response()
                    ->json([
                        // "data"    => [],
                        "message" => "Credentials do not match.",
                        "status"  => false,
                    ]);

            }

            $token                 = $factory->createToken('auth-token');
            $factory->access_token = $token->plainTextToken;
            return response()
                ->json([
                    "data"    => $factory,
                    "message" => "Successfully logged in.",
                    "status"  => true,
                ]);

        }
        $vendor = Vendor::where('username', $request->username)->first();
        if (!$vendor || !Hash::check($request->password, $vendor->password)) {
            return response()
                ->json([
                    // "data"    => [],
                    "message" => "Credentials do not match.",
                    "status"  => false,
                ]);

        }

        // $vendor               = Vendor::inRandomOrder()->first();
        $token                = $vendor->createToken('auth-token');
        $vendor->access_token = $token->plainTextToken;
        return response()
            ->json([
                "data"    => $vendor,
                "message" => "Successfully logged in.",
                "status"  => true,
            ]);

    }
}
