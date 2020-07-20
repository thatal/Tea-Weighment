<?php

namespace App\Services;

use App\Models\DailyFineLeafCount;
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
    public static function getTodaysFineLeafPrice($today = false, $guard = "web"){
        $query = DailyFineLeafCount::query();
        $user =auth($guard)->user();
        if($user->isHeadQuarter()){
            $query->where("headquarter_id", $user->id);
        }
        if($user->isFactory()){
            $query->whereIn("headquarter_id", function($query) use ($user){
                $query->select("headquarter_id")->from("factory_information")->where("user_id", $user->id);
            });
        }
        if($today){
            $query->whereDate("date", today()->format("Y-m-d"));
        }
        $data = $query->get();
        return $data;
    }
}
