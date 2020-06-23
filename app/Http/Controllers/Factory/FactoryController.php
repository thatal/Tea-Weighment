<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function vendorOffers()
    {
        if(request("export") === "excel"){
            return VendorOfferService::all();
        }
        $vendor_offers = VendorOfferService::all();
        // dd($vendor_offers);
        return view("factory.reports.vendor-offers", compact("vendor_offers"));
    }
}
