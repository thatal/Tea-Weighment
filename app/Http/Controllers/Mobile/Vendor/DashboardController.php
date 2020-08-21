<?php

namespace App\Http\Controllers\Mobile\Vendor;

use App\Http\Controllers\Controller;
use App\Models\DailyFineLeafCount;
use App\Models\Factory;
use App\Models\Vehicle;
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
        $factories = Factory::/* with(["factory_information"]) */select(["id", "name"])->available()->get();
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
        $slabs = DailyFineLeafCount::get();
        return response()->json([
            "data"    => $slabs,
            "status"  => true,
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
            return response()
                ->json([
                    "data"    => $validator->errors(),
                    "status"  => false,
                    "message" => "Validation error.",
                ]);
        }
        try {
            $daily_fine_leaf_count = DailyFineLeafCount::findOrFail(request("daily_leaf_count_id"));
            $offer_data = [
                "vendor_id"                => auth("sanctum")->id(),
                "factory_id"               => request("factory_id"),
                "offer_price"              => $daily_fine_leaf_count->price,
                "expected_fine_leaf_count" => $daily_fine_leaf_count->fine_leaf_count_from."-".$daily_fine_leaf_count->fine_leaf_count_to." %",
                "expected_moisture"        => request("expected_moisture"),
                "leaf_quantity"            => request("leaf_quantity"),
            ];
            VendorOffer::create($offer_data);
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
            // "offer_price"              => "required|numeric|min:1",
            "expected_moisture"        => "required|numeric|min:0",
            // "expected_fine_leaf_count" => "required|numeric|min:1",
            "leaf_quantity"            => "required|numeric|min:0",
            "daily_leaf_count_id"      => "required|exists:daily_fine_leaf_counts,id"
        ];
    }

}
