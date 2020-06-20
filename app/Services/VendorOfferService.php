<?php

namespace App\Services;

use App\Exceptions\PermissionDenied;
use App\Models\FactoryInformation;
use App\Models\VendorOffer;
use Log;

class VendorOfferService
{
    private static $permision_denied_mesage = "You dont have permission to confirm the offer.";
    public static function all($paginate = 4, $guard = "web")
    {
        $vendor_offers = VendorOffer::query();
        $vendor_offers->when(CommonService::isFactory(), function($query) use ($guard){
            return $query->where("vendor_id", auth($guard)->user()->id);
        });
        return $vendor_offers->whereDate("created_at", today()->format("Y-m-d"))
            ->with(["vendor"])
            ->pending()
            ->latest()
            ->paginate($paginate);
    }
    public static function todayReports($paginate = 4, $guard = "web")
    {
        $vendor_offers = VendorOffer::query();
        $vendor_offers->when(CommonService::isFactory(), function($query) use ($guard){
            return $query->where("vendor_id", auth($guard)->user()->id);
        });
        return $vendor_offers->whereDate("created_at", today()->format("Y-m-d"))
            ->with(["vendor"])
            ->pending()
            ->latest()
            ->paginate($paginate);
    }
    public static function confirmOffer(VendorOffer $vendorOffer, $guard = "web")
    {
        if (CommonService::isFactory()) {
            if (auth($guard)->user()->id !== $vendorOffer->factory_id) {
                Log::alert('Permission denied confirm order factory');

                throw new PermissionDenied(self::$permision_denied_mesage, 401);
            }

        }elseif (CommonService::isHeadQuarter()) {
            $vendor_belongs_to_factory = FactoryInformation::where("headquarter_id", auth($guard)->id)
                ->where("user_id", $vendorOffer->factory_id)
                ->exist();
            if (!$vendor_belongs_to_factory) {
                Log::alert('Permission denied confirm order headquarter');
                throw new PermissionDenied(self::$permision_denied_mesage, 401);
            }
        }
        $confirmation_no = date("Y") . (10000 + $vendorOffer->id);
        return $vendorOffer->update([
            "confirmed_at"      => now()->format("Y-m-d H:i:s"),
            "confirmed_by_id"   => auth($guard)->id(),
            "confirmation_code" => $confirmation_no,
            "status"            => "confirmed",
        ]);
    }
}
