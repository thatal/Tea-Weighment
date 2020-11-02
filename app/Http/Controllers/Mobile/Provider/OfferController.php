<?php

namespace App\Http\Controllers\Mobile\Provider;

use App\Http\Controllers\Controller;
use App\Services\VendorOfferService;

class OfferController extends Controller
{
    public function index()
    {
        $vendor_offers = VendorOfferService::all(50, "sanctum");
        return response()->json([
            "message" => $vendor_offers->total() . " records found ",
            "data"    => $vendor_offers,
            "status"  => true,
        ]);
    }
}
