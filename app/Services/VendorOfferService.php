<?php

namespace App\Services;

use App\Exceptions\PermissionDenied;
use App\Exports\VendorOfferExport;
use App\Models\FactoryInformation;
use App\Models\VendorOffer;
use Excel;
use Illuminate\Database\Eloquent\Builder;
use Log;

class VendorOfferService
{
    private static $permision_denied_mesage = "You dont have permission to confirm the offer.";
    public static function all($paginate = 100, $guard = "web")
    {
        $vendor_offers = VendorOffer::query();
        $vendor_offers->when(CommonService::isFactory(), function($query) use ($guard){
            return $query->where("factory_id", auth($guard)->user()->id);
        });
        $vendor_offers->when(CommonService::isVendor($guard), function ($query) use ($guard) {
            return $query->where("vendor_id", auth($guard)->user()->id);
        });

        $vendor_offers = self::mainFilter($vendor_offers);
        $vendor_offers->with(["vendor", "factory"])
            ->latest();
        if(request("export") === "excel"){
            return Excel::download(new VendorOfferExport($vendor_offers->get()), "vendor_offer_.xlsx");
        }
        return $vendor_offers
            ->paginate($paginate);
    }
    public static function todayReports($paginate = 10, $guard = "web")
    {
        $vendor_offers = VendorOffer::query();
        $vendor_offers->when(CommonService::isFactory($guard), function($query) use ($guard){
            return $query->where("factory_id", auth($guard)->user()->id);
        });
        $vendor_offers->when(CommonService::isVendor($guard), function($query) use ($guard){
            return $query->where("vendor_id", auth($guard)->user()->id);
        });
        return $vendor_offers->whereDate("created_at", today()->format("Y-m-d"))
            ->with(["vendor", "factory"])
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
            "status"            => VendorOffer::$confirm_status,
        ]);
    }
    public static function mainFilter(Builder $builder)
    {
        $builder->when(request("offer_status"), function ($query) {
            if (request("offer_status") == VendorOffer::$confirm_status) {
                return $query->confirmed();
            } else if (request("offer_status") == VendorOffer::$pending_status) {
                return $query->pending();
            } else {
                return $query->where("status", request("offer_status"));
            }
        });
        $builder->when(request("date_from"), function ($query) {
            return $query->whereDate("created_at", ">=", request("date_from"));
        });
        $builder->when(request("date_to"), function ($query) {
            return $query->whereDate("created_at", "<=", request("date_to"));
        });
        $builder->when(request("vendor"), function ($query) {
            return $query->where("vendor_id", request("vendor"));
        });

        return $builder;
    }
}
