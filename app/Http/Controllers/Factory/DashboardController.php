<?php

namespace App\Http\Controllers\Factory;

use App\Exceptions\PermissionDenied;
use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\CommonService;
use App\Services\VendorOfferService;

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
            $message = "Vendor can't sent quotation.";
            if($factory_information->is_available){
                $message = "Vendor can now sent quotation.";
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

}
