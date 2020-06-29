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

    public function summaryReport()
    {
        $summary_reports = VendorOfferService::summaryReport();
        // return $summary_reports;
        return view("factory.reports.summary-vendor-offers", compact("summary_reports"));

    }
}
