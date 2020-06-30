<?php

namespace App\Http\Controllers\Headquarter;

use App\Exceptions\PermissionDenied;
use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view("headquarter.dashboard");
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
