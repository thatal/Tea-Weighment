<?php

namespace App\Http\Controllers\Headquarter;

use App\Exceptions\PermissionDenied;
use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;
use Log;

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
            VendorOfferService::confirmOffer($vendorOffer);
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
            VendorOfferService::cancelOffer($vendorOffer);
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
}
