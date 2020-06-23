<?php

namespace App\Services;

use App\Models\FactoryInformation;
use App\Models\Vendor;

class CommonService
{


    public static function isHeadQuarter($guard = "web")
    {
        return (auth($guard)->check() && auth($guard)->user()->role === "headquarter");
    }
    public static function isFactory($guard = "web")
    {
        return (auth($guard)->check() && auth($guard)->user()->role === "factory");
    }
    public static function isVendor($guard = "web")
    {
        return (auth($guard)->check() && auth($guard)->user()->role === "vendor");
    }

    public static function factory_information(){
        return FactoryInformation::where("user_id", auth()->id())->first();
    }

    public static function vendor_array($for_select = false){
        $vendors = Vendor::query();
        $vendors->when(self::isFactory(), function($query){
            return $query->whereIn("id", function($query){
                return $query->select("vendor_id")->from("vendor_offers")->where("factory_id", auth()->id());
            });
        });
        if($for_select){
            return ["" => "All"] + $vendors->pluck("name", "id")->toArray();
        }
        return $vendors->get();
    }
}
