<?php

namespace App\Http\Controllers\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\Headquarter;
use App\Models\Vendor;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Log;
use Validator;

class AuthController extends Controller
{
    public function register()
    {
        $validator = Validator::make(request()->all(), $this->registerRules());
        if ($validator->fails()) {
            return response()
                ->json([
                    "message" => implode(",", $validator->errors()->all()),
                    "status"  => false,
                    // "data"    => $validator->errors(),
                ]);
        }
        DB::beginTransaction();
        try {
            $vendor = Vendor::create([
                "name"     => request("name"),
                "username" => request("mobile"),
                "email"    => request("email"),
                "password" => bcrypt(request("password")),
            ]);
            $headquarter = Headquarter::where("username", request("companyCode"))->first();
            $vendor_info = [
                "mobile" => request("mobile"),
                "headquarter_id" => $headquarter->id,
            ];
            $vendor_address = [
                "address_1" => request("address_1"),
                "address_2" => request("address_2"),
                "pin"       => request("pin"),
            ];
            $vendor_bank = [
                "bank_name"           => request("bank_name"),
                "account_number"      => request("account_number"),
                "account_holder_name" => request("account_holder_name"),
                "ifsc_code"           => request("ifsc_code"),
                "is_primary"          => 1,
            ];
            $vendor->address()->create($vendor_address);
            $vendor->vendor_information()->create($vendor_info);
            $vendor->bank_details()->create($vendor_bank);
            $vendor->refresh();
            $vendor->load(["address", "vendor_information", "bank_details"]);
            $token                = $vendor->createToken('auth-token');
            $vendor->access_token = $token->plainTextToken;

        } catch (\Throwable $th) {
            DB::rollback();
            Log::error($th);
            return response()
                ->json([
                    "message" => "Supplier registration failed.",
                    // "data"    => null,
                    "status"  => false,
                ]);

        }
        DB::commit();
        return response()
            ->json([
                "message" => "Successfully registered.",
                "data"    => $vendor,
                "status"  => true,
            ]);

    }
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
            $factory->load(["address", "factory_information"]);
            $token                 = $factory->createToken('auth-token');
            $factory->access_token = $token->plainTextToken;
            return response()
                ->json([
                    "data"    => $factory,
                    "message" => "Successfully logged in.",
                    "status"  => true,
                ]);

        }
        if ($request->get("role") === "approver") {
            $headquarter = Headquarter::where('username', $request->username)->first();
            if (!$headquarter || !Hash::check($request->password, $headquarter->password)) {
                return response()
                    ->json([
                        // "data"    => [],
                        "message" => "Credentials do not match.",
                        "status"  => false,
                    ]);

            }
            $token                 = $headquarter->createToken('auth-token');
            $headquarter->access_token = $token->plainTextToken;
            return response()
                ->json([
                    "data"    => $headquarter,
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
        $vendor->load(["address", "vendor_information", "bank_details"]);

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

    public function changePassword()
    {
        $validator = Validator::make(request()->all(), $this->changePasswordRules());
        if($validator->fails()){
            return response()
                ->json([
                    "message"   => "Please fix the issue.",
                    "data"      => $validator->errors(),
                    "status"    => false
                ]);
        }
        try {

            $vendor_id = auth("sanctum")->id();
            $vendor = Vendor::find($vendor_id);

            if (!Hash::check(request("current_password"), $vendor->password)) {
                return response()
                    ->json([
                        "message" => "Current password does not match.",
                        "data"    => null,
                        "status"  => false,
                    ]);
            }

            $vendor->password = bcrypt(request("password"));
            $vendor->save();

        } catch (\Throwable $th) {
            return response()
                ->json([
                    "message" => "Whoops! something went wrong.",
                    // "data"      => $vendor,
                    "status"  => false,
                ]);

        }

        return response()
            ->json([
                "message"   => "Password Successfully changed.",
                // "data"      => $vendor,
                "status"    => true
            ]);
    }
    private function registerRules()
    {
        return [
            // personal details
            "name"                => "required|max:100",
            "mobile"              => "required|digits:10|unique:users,username",
            "email"               => "nullable|email|unique:users",
            "password"            => "required|confirmed",
            // address
            "address_1"           => "required|max:255",
            "address_2"           => "nullable|max:255",
            "pin"                 => "required|digits:6",
            "companyCode"         => "required|".Rule::exists("users", "username")->where(function($query){
                return $query->where("role", Headquarter::$role);
            }),
            // bank details
            "bank_name"           => "required|max:255",
            "account_number"      => "required|max:50",
            "account_holder_name" => "required|max:100",
            "ifsc_code"           => "required|max:100",
        ];
    }

    private function changePasswordRules(){
        return [
            "password"  => "required|confirmed",
            "current_password"  => "required"
        ];
    }
}
