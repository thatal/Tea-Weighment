<?php

namespace App\Services;

class CommonService
{


    public static function isHeadQuarter()
    {
        return (auth()->check() && auth()->user()->role === "headquarter");
    }

}
