<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function vendorReports()
    {
        if (request("export") === "excel") {
            return VendorOfferService::all();
        }
        $vendor_offers = VendorOfferService::all();
        // dd($vendor_offers);
        return view("admin.vendor-offer.index", compact("vendor_offers"));

    }
}
