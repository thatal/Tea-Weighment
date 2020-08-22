<?php

namespace App\Http\Controllers\Factory;

use App\Exceptions\PermissionDenied;
use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\CommonService;
use App\Services\VendorOfferService;
use Validator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $daily_collections = VendorOfferService::todayReports(4);
        return view("factory.dashboard", compact("daily_collections"));
    }
    public function switchAvailable(){
        try {
            $status = true;
            $factory_information = CommonService::factory_information();
            $factory_information->update([
                "is_available"  => !$factory_information->is_available
            ]);
            $message = "Vendor can't send quotation.";
            if($factory_information->is_available){
                $message = "Vendor can now send quotation.";
            }
        } catch (\Throwable $th) {
            $message = "Whoops! something went wrong try again later.";
            $status = false;
            \Log::error($th);
        }

        return response()->json([
            "status"    => $status,
            "message"    => $message
        ]);
    }

    public function confirmOrder(VendorOffer $vendorOffer)
    {
        try {
            VendorOfferService::confirmOffer($vendorOffer);
            return redirect()
                ->back()
                ->with("success", "Offer Accepted successfully.");
        } catch(PermissionDenied $e){
            return redirect()
                ->back()
                ->with("error", $e->getMessage());

        }catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong. Try again later");
        }
    }

    public function cancelOffer(VendorOffer $vendorOffer)
    {
        try {
            VendorOfferService::cancelOffer($vendorOffer);
            return redirect()
                ->back()
                ->with("success", "Offer Cancelled successfully.");
        } catch(PermissionDenied $e){
            return redirect()
                ->back()
                ->with("error", $e->getMessage());

        }catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong. Try again later");
        }
    }

    public function incentiveVendorOffer(VendorOffer $vendorOffer)
    {
        if($vendorOffer->factory_id !== auth()->id()){
            return response()
                ->json([
                    "message"   => "Access denied.",
                ], 401);
            return redirect()
                ->back()
                ->with("error", "Access Denied.");
        }
        $validator = Validator::make(request()->all(), [
            "incentive_per_kg"  => "required|numeric|min:0",
        ]);
        if($validator->fails()){
            return response()
                ->json([
                    "message"   => implode(",", $validator->errors()->all()),
                ], 422);
        }
        try {
            $vendorOffer->incentive_per_kg    = request("incentive_per_kg");
            $vendorOffer->incentive_total     = request("incentive_per_kg") * $vendorOffer->net_weight;
            $vendorOffer->incentive_added_by_id     = auth()->id();
            $vendorOffer->save();
        } catch (\Throwable $th) {
            \Log::error($th);
            return response()
                ->json([
                    "message"   => "Whoops! Something went wrong. try again later.",
                ], 422);
        }
        return response()
        ->json([
            "message"   => "Successfully updated Incentive..",
        ]);

    }
}
