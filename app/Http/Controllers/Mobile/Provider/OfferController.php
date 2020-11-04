<?php

namespace App\Http\Controllers\Mobile\Provider;

use App\Exceptions\PermissionDenied;
use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Log;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\Response;

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

    public function confirmOrder(VendorOffer $vendorOffer)
    {
        try {
            VendorOfferService::confirmOffer($vendorOffer, "sanctum");
            return response()
                ->json([
                    "message" => "Confirmed successfully.",
                    "status" => true,
                ]);
        } catch(PermissionDenied $e){
            Log::error($e);
            return response()
                ->json([
                    "message" => $e->getMessage(),
                    "status" => false,
                ]);

        }catch (\Throwable $th) {
            Log::error($th);
            return response()
                ->json([
                    "message" => $th->getMessage(),
                    "status" => false,
                ]);
        }
    }

    public function cancelOffer(VendorOffer $vendorOffer)
    {
        try {
            VendorOfferService::cancelOffer($vendorOffer, "sanctum");
            return response()
                ->json([
                    "message" => "Offer Cancelled successfully.",
                    "status" => true,
                ]);
        } catch(PermissionDenied $e){
            return response()
                ->json([
                    "message" => $e->getMessage(),
                    "status" => false,
                ]);

        }catch (\Throwable $th) {
            Log::error($th);
            return response()
                ->json([
                    "message" =>  "Whoops! something went wrong. Try again later.",
                    "status" => false,
                ]);
        }
    }
    public function counterOffer(Request $request, VendorOffer $vendorOffer)
    {
        return $vendorOffer;
        $rules = [
            "counter_price" => "required|min:1"
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()
                ->json([
                    "message" =>  "Please fix the error.",
                    "status" => false,
                ]);
        }
        try {
            VendorOfferService::counterOffer($vendorOffer, "sanctum");
            return response()
                ->json([
                    "message" =>  "Counter Offer sent Successfully.",
                    "status" => true,
                ]);
        } catch(PermissionDenied $e){
            return response()
                ->json([
                    "message" =>  $e->getMessage(),
                    "status" => false,
                ]);

        }catch (\Throwable $th) {
            Log::error($th);
            return response()
                ->json([
                    "message" =>  "Whoops! something went wrong. Try again later.",
                    "status" => false,
                ], Response::HTTP_CREATED);
        }
    }
}
