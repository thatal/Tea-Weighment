<?php

namespace App\Services;

use App\Models\FactoryInformation;

class CommonService
{


    public static function isHeadQuarter()
    {
        return (auth()->check() && auth()->user()->role === "headquarter");
    }

    public static function factory_information(){
        return FactoryInformation::where("user_id", auth()->id())->first();
    }
}
