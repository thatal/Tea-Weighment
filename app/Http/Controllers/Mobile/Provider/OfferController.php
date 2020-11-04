<?php

namespace App\Http\Controllers\Mobile\Provider;

use App\Exceptions\PermissionDenied;
use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Log;
use Request;
use Validator;

class OfferController extends Controller
{
    public function index()
    {
        $vendor_offers = VendorOfferService::all(50, "sanctum");
        return response()->json([
            "message" => $vendor_offers->total() . " records found ",
            "status"  => true,
            $vendor_offers,
        ]);
    }
}
