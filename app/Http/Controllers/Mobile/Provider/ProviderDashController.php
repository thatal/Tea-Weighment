<?php

namespace App\Http\Controllers\Mobile\Provider;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Models\VendorOffer;
use App\Services\SupplierService;

class ProviderDashController extends Controller
{
    public function importantApiData()
    {
        $factories    = [];
        $offer_status = [];
        $suppliers    = [];
        $factories =  Factory::select(["id", "name"])
        ->whereHas("factory_information", function($query){
            return $query->where("headquarter_id", auth("sanctum")->id());
        })
        ->available()
        ->get();
        \DB::listen(function($query){
            \Log::info($query->sql);
            \Log::info($query->bindings);
        });
        $suppliers = app(SupplierService::class)->getAllSuppllierUsingFilter();
        $offer_status = collect(VendorOffer::$statuses)->map(function($item){
            return ucwords(str_replace("_", " ", $item));
        })->toArray();;
        return response()
            ->json([
                "status"       => true,
                "factories"    => $factories,
                "suppliers"    => $suppliers,
                "offer_status" => $offer_status,
            ]);
    }
}
