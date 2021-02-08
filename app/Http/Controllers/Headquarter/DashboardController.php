<?php

namespace App\Http\Controllers\Headquarter;

use App\Exceptions\PermissionDenied;
use App\Http\Controllers\Controller;
use App\Http\Requests\HCounterOffer;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;
use Log;
use Validator;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $daily_collections = VendorOfferService::todayReports(4);

        return view("headquarter.dashboard", compact("daily_collections"));
    }

    public function confirmOrder(VendorOffer $vendorOffer)
    {
        try {
            $offer = VendorOfferService::confirmOffer($vendorOffer);
            $offer->notifyRejectedByFactoryNotification();
            return redirect()
                ->back()
                ->with("success", "Offer Accepted successfully.");
        } catch(PermissionDenied $e){
            Log::error($e);
            return redirect()
                ->back()
                ->with("error", $e->getMessage());

        }catch (\Throwable $th) {
            Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong. Try again later");
        }
    }

    public function cancelOffer(VendorOffer $vendorOffer)
    {
        try {
            $offer = VendorOfferService::cancelOffer($vendorOffer);
            $offer->notifyRejectedByFactoryNotification();

            return redirect()
                ->back()
                ->with("success", "Offer Cancelled successfully.");
        } catch(PermissionDenied $e){
            return redirect()
                ->back()
                ->with("error", $e->getMessage());

        }catch (\Throwable $th) {
            Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong. Try again later");
        }
    }
    public function counterOffer(Request $request, VendorOffer $vendorOffer)
    {
        $rules = [
            "counter_price" => "required|min:1"
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->with("error", "Please fix the error.");
        }
        try {
            VendorOfferService::counterOffer($vendorOffer);
            return redirect()
                ->back()
                ->with("success", "Counter Offer sent Successfully.");
        } catch(PermissionDenied $e){
            return redirect()
                ->back()
                ->with("error", $e->getMessage());

        }catch (\Throwable $th) {
            Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong. Try again later");
        }
    }
}
