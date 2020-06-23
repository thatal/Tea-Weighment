<?php

namespace App\Services;

use App\Models\FactoryInformation;
use App\Models\Vendor;

class CommonService
{


    public static function isHeadQuarter()
    {
        return (auth()->check() && auth()->user()->role === "headquarter");
    }
    public static function isFactory()
    {
        return (auth()->check() && auth()->user()->role === "factory");
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
