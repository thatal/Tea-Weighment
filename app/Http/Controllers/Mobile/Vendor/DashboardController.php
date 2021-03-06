<?php

namespace App\Http\Controllers\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Models\DailyFineLeafCount;
use App\Models\Factory;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;
use Log;
use Validator;

class DashboardController extends Controller
{
    private $guard = "sanctum";
    public function factoryFetch()
    {
        $user_id = auth($this->guard)->id();
        $vendor = Vendor::with("vendor_information")->findOrFail($user_id);
        $factories = Factory::/* with(["factory_information"]) */select(["id", "name"])
        ->whereHas("factory_information", function($query) use ($vendor){
            return $query->where("headquarter_id", $vendor->vendor_information->headquarter_id);
        })
        ->available()
        ->get();
        return response()->json([
            "data"    => $factories,
            "status"  => true,
            "message" => $factories->count() . " records found.",
        ]);
    }
    // slab is the fine leaf count rates
    public function factorySlabFetch()
    {
        $validator = Validator::make(request()->all(),[
            "factory_id"    => "required|exists:users,id"
        ]);
        if($validator->fails()){
            return response()->json([
                "data"      => $validator->errors(),
                "status"    => false,
                "message"   => implode(",", $validator->errors()->all())
            ]);
        }
        $slabs = DailyFineLeafCount::where("factory_id", request("factory_id"))->active()->get();
        return response()->json([
            "data"    => $slabs,
            "status"  => true,
            "show_slab" => auth()->user()->show_slab,
            "message" => $slabs->count() . " records found.",
        ]);
    }
    public function vehicleFetch()
    {
        $vehicles = Vehicle::select(["id", "name", "weight"])->get();
        return response()->json([
            "data"    => $vehicles,
            "status"  => true,
            "message" => $vehicles->count() . " records found.",
        ]);
    }

    public function offerCreate(Request $request)
    {
        $validator = Validator::make($request->all(), $this->offerCreateRule());
        if ($validator->fails()) {
            Log::info(request()->all());
            Log::error($validator->errors()->all());
            return response()
                ->json([
                    "data"    => $validator->errors(),
                    "status"  => false,
                    "message" =>  implode(",", $validator->errors()->all()),
                ]);
        }
        try {
            $daily_fine_leaf_count = DailyFineLeafCount::findOrFail(request("expected_fine_leaf_count"));
            $offer_data = [
                "vendor_id"                => auth("sanctum")->id(),
                "factory_id"               => request("factory_id"),
                "offer_price"              => request("offer_price"),
                "expected_fine_leaf_count" => $daily_fine_leaf_count->fine_leaf_count_from."-".$daily_fine_leaf_count->fine_leaf_count_to,
                "expected_moisture"        => request("expected_moisture") ?? 0,
                "leaf_quantity"            => request("leaf_quantity"),
            ];
            $offer = VendorOffer::create($offer_data);
            // sending  mobile push notification to both supplier and factory
            $offer->notifyCreatedNotification();
        } catch (\Throwable $th) {
            Log::error($th);
            return response()
                ->json([
                    "data"    => [],
                    "status"  => false,
                    "message" => "Something went wrong please try again later.",
                ]);
        }
        return response()
            ->json([
                "data"    => [],
                "message" => "Offer Successfully Sent",
                "status"  => true,
            ]);
    }

    public function fetchVendorOffers()
    {
        $offers = VendorOfferService::all(100, $this->guard);
        return response()
            ->json([
                "message" => $offers->total() . " records found.",
                "data"    => $offers,
                "status"  => true,
            ]);
    }
    public function rejectOffer()
    {
        $vendorOffer = VendorOffer::find(request("offer_id"));
        try {
            $vendorOffer = VendorOfferService::rejectBySupplierOffer($vendorOffer);
            $vendorOffer->notifyRejectedBySupplierNotification();
        } catch (\Throwable $th) {
            return response()
                ->json([
                    "message" => $th->getMessage(),
                    "data"    => $vendorOffer,
                    "status"  => false,
                ]);

        }
        return response()
            ->json([
                "message" => "Offer rejected Successfully.",
                "data"    => $vendorOffer,
                "status"  => true,
            ]);

    }
    public function acceptOffer()
    {
        $vendorOffer = VendorOffer::find(request("offer_id"));
        try {
            $vendorOffer = VendorOfferService::acceptOffer($vendorOffer);
            $vendorOffer->notifyAcceptedBySupplierNotification();
        } catch (\Throwable $th) {
            return response()
                ->json([
                    "message" => $th->getMessage(),
                    "data"    => $vendorOffer,
                    "status"  => false,
                ]);

        }
        return response()
            ->json([
                "message" => "Offer Accepted Successfully.",
                "data"    => $vendorOffer,
                "status"  => true,
            ]);

    }
    public function fetchVendorTodayOffers()
    {
        $offers = VendorOfferService::todayReports(100, $this->guard);
        return response()
            ->json([
                "message" => $offers->total() . " records found.",
                "data"    => $offers,
                "status"  => true,
            ]);
    }

    private function offerCreateRule()
    {
        return [
            "factory_id"               => "required|exists:users,id",
            "offer_price"              => "required|numeric|min:1",
            "expected_moisture"        => "nullable|numeric|min:0",
            "expected_fine_leaf_count" => "exists:daily_fine_leaf_counts,id",
            "leaf_quantity"            => "required|numeric|min:0",
            // "daily_leaf_count_id"      => "required|exists:daily_fine_leaf_counts,id"
        ];
    }
    public function counterOffer()
    {
        $rules = [
            "counter_price" => "required|min:1",
            "id"            => "required|exists:vendor_offers,id",
        ];
        $validator = Validator::make(request()->all(), $rules);
        if($validator->fails()){
            return response()
                ->json([
                    "message" =>  "Please fix the error.",
                    "status" => false,
                ]);
        }
        try {
            $vendorOffer = VendorOffer::findOrFail(request("id"));
            $vendorOffer = VendorOfferService::counterOfferVendor($vendorOffer, "sanctum");
        } catch (\Throwable $th) {
            return response()
                ->json([
                    "message" => $th->getMessage(),
                    "data"    => $vendorOffer,
                    "status"  => false,
                ]);

        }
        return response()
            ->json([
                "message" => "Couner offer successfully sent.",
                "data"    => $vendorOffer,
                "status"  => true,
            ]);

    }

}
