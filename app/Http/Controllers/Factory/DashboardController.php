<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Services\CommonService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view("factory.dashboard");
    }
        public function switchAvailable(){
        try {
            $status = true;
            $factory_information = CommonService::factory_information();
            $factory_information->update([
                "is_available"  => !$factory_information->is_available
            ]);
            $message = "Vendor can't sent quotation.";
            if($factory_information->is_available){
                $message = "Vendor can now sent quotation.";
            }
        } catch (\Throwable $th) {
            $message = "Whoops! something went wrong try again later.";
            $status = false;
            \Log::error($th);
        }

        return response()->json([
            "status"    => $status,
            "message"    => $message
        ]);
    }

}
