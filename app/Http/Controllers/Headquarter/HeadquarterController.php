<?php

namespace App\Http\Controllers\Headquarter;

use App\Http\Controllers\Controller;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;

class HeadquarterController extends Controller
{
    public function vendorOffers()
    {
        if (request("export") === "excel") {
            return VendorOfferService::all();
        }
        $vendor_offers = VendorOfferService::all();
        // dd($vendor_offers);
        return view("headquarter.reports.vendor-offers", compact("vendor_offers"));
    }

    public function summaryReport()
    {
        $summary_reports = VendorOfferService::summaryReport();
        // return $summary_reports;
        return view("headquarter.reports.summary-vendor-offers", compact("summary_reports"));

    }
}
