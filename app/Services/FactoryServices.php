<?php
namespace App\Services;

use App\Models\Factory;

class FactoryServices
{
    public static function index(){
        $factories = Factory::query();
        $factories->when(CommonService::isHeadQuarter(), function($query){
            return $query->whereHas("factory_information", function($query){
                return $query->where("headquarter_id", auth()->user()->id);
            });
        })->with("factory_information");
        return $factories->paginate(50);
    }
}
