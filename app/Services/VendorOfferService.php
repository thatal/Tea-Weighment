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
        $vendor_offers->when(CommonService::isFactory($guard), function ($query) use ($guard) {
            return $query->where("factory_id", auth($guard)->user()->id);
        });
        $vendor_offers->when(CommonService::isVendor($guard), function ($query) use ($guard) {
            return $query->where("vendor_id", auth($guard)->user()->id);
        });
        $vendor_offers->when(auth($guard)->user()->isHeadquarter(), function ($query) use ($guard) {
            return $query->whereIn("factory_id", function ($query) use ($guard) {
                return $query->select("user_id")->from("factory_information")->where("headquarter_id", auth($guard)->id());
            });
        });
        $vendor_offers = self::mainFilter($vendor_offers);
        $vendor_offers->with(["vendor", "factory", "vehicle" => function ($select) {
            return $select->select(["name", "id"]);
        }])
            ->latest();
        if (request("export") === "excel") {
            return Excel::download(new VendorOfferExport($vendor_offers->get()), "vendor_offer_.xlsx");
        }
        return $vendor_offers
            ->paginate($paginate);
    }
    public static function summaryReport($guard = "web")
    {
        $month = date("m");
        if (request("month")) {
            $month = request("month");
        }
        $vendor_offers = VendorOffer::query();
        $vendor_offers->when(CommonService::isFactory(), function ($query) use ($guard) {
            return $query->where("factory_id", auth($guard)->user()->id);
        });
        $vendor_offers->when(CommonService::isVendor($guard), function ($query) use ($guard) {
            return $query->where("vendor_id", auth($guard)->user()->id);
        });
        // $vendor_offers->whereMonth("created_at", $month);
        $vendor_offers->where("status", VendorOffer::$second_wieght_status);
        // $vendor_offers->whereNotNull("leaf_count_added_at");
        // $vendor_offers = self::mainFilter($vendor_offers);
        $vendor_offers->with(["vendor", "factory"])
            ->selectRaw('vendor_id, factory_id,
            net_weight as sum_weight,
            confirmation_code,
            vehicle_number,
            first_weight as gross,
            second_weight as tare,
            deduction,
            confirmed_fine_leaf_count as fine_leaf,
            final_rate as rate,
            (total_amount + incentive_total) as amount,
            incentive_total,
            date(created_at) as date');
        if (request("export") === "excel") {
            // return Excel::download(new VendorOfferExport($vendor_offers->get()), "vendor_offer_.xlsx");
        }

        $vendor_offers = $vendor_offers->get()->makeHidden(["first_weight_image_url", "second_weight_image_url"]);
        $grouped       = $vendor_offers->groupBy("vendor_id");
        $grouped_data  = [];
        // dump($grouped);
        $grouped->each(function ($item) use (&$grouped_data) {
            $grouped_data["records"][] = [
                "data"                 => $item,
                "vendor"               => $item->first()->vendor,
                "sub_total_amount"     => $item->sum("amount"),
                "sub_total_gross"      => $item->sum("gross"),
                "sub_total_tare"       => $item->sum("tare"),
                "sub_total_deduction"  => $item->sum("deduction"),
                "sub_total_net_weight" => $item->sum("sum_weight"),
                "sub_total_rate"       => number_format($item->avg("rate"), 2, ".", ""),
                "sub_total_fine_leaf"  => number_format($item->avg("fine_leaf"), 2, ".", ""),
                "sub_incentive"        => $item->sum("incentive_total"),

            ];
        });
        unset($grouped);
        unset($vendor_offers);
        $grouped_data = collect($grouped_data)->map(function ($row) {
            return collect($row);
        });
        // dd($grouped_data);
        $grouped_data["grand_total_amount"]     = isset($grouped_data["records"]) ? $grouped_data["records"]->sum("sub_total_amount") : 0;
        $grouped_data["grand_total_gross"]      = isset($grouped_data["records"]) ? $grouped_data["records"]->sum("sub_total_gross") : 0;
        $grouped_data["grand_total_tare"]       = isset($grouped_data["records"]) ? $grouped_data["records"]->sum("sub_total_tare") : 0;
        $grouped_data["grand_total_deduction"]  = isset($grouped_data["records"]) ? $grouped_data["records"]->sum("sub_total_deduction") : 0;
        $grouped_data["grand_total_net_weight"] = isset($grouped_data["records"]) ? $grouped_data["records"]->sum("sub_total_net_weight") : 0;
        $grouped_data["grand_total_rate"]       = isset($grouped_data["records"]) ? number_format($grouped_data["records"]->avg("sub_total_rate"), 2, ".", "") : 0;
        $grouped_data["grand_total_fine_leaf"]  = isset($grouped_data["records"]) ? number_format($grouped_data["records"]->avg("sub_total_fine_leaf"), 2, ".", "") : 0;
        $grouped_data["grand_total_incentive"]  = isset($grouped_data["records"]) ? $grouped_data["records"]->sum("sub_incentive") : 0;
        // dd($grouped_data);
        return $grouped_data;

    }
    public static function todayReports($paginate = 10, $guard = "web")
    {
        $vendor_offers = VendorOffer::query();
        $vendor_offers->when(CommonService::isFactory($guard), function ($query) use ($guard) {
            return $query->where("factory_id", auth($guard)->user()->id);
        });
        $vendor_offers->when(CommonService::isVendor($guard), function ($query) use ($guard) {
            return $query->where("vendor_id", auth($guard)->user()->id);
        });
        $vendor_offers->when(auth($guard)->user()->isHeadquarter(), function ($query) use ($guard) {
            return $query->whereIn("factory_id", function ($query) use ($guard) {
                return $query->select("user_id")->from("factory_information")->where("headquarter_id", auth($guard)->id());
            });
        });

        return $vendor_offers->whereDate("created_at", today()->format("Y-m-d"))
            ->with(["vendor", "factory", "vehicle"])
        // ->pending()
            ->latest()
            ->paginate($paginate);
    }
    public static function confirmOffer(VendorOffer $vendorOffer, $guard = "web")
    {
        if (CommonService::isFactory($guard)) {
            if (auth($guard)->user()->id !== $vendorOffer->factory_id) {
                Log::alert('Permission denied confirm order factory');

                throw new PermissionDenied(self::$permision_denied_mesage, 401);
            }

        } elseif (CommonService::isHeadQuarter($guard)) {
            $vendor_belongs_to_factory = FactoryInformation::where("headquarter_id", auth($guard)->id())
                ->where("user_id", $vendorOffer->factory_id)
                ->exists();
            if (!$vendor_belongs_to_factory) {
                Log::alert('Permission denied confirm order headquarter');
                throw new PermissionDenied(self::$permision_denied_mesage, 401);
            }
        }
        $confirmation_no = date("Y") . (10000 + $vendorOffer->id);
        $vendorOffer->update([
            "confirmed_at"              => now()->format("Y-m-d H:i:s"),
            "confirmed_price"           => $vendorOffer->offer_price,
         /*    "confirmed_fine_leaf_count" => $vendorOffer->expected_fine_leaf_count,
            "confirmed_moisture"        => $vendorOffer->expected_moisture, */
            "confirmed_by_id"           => auth($guard)->id(),
            "confirmed_by_type"         => get_class(auth($guard)->user()),
            "confirmation_code"         => $confirmation_no,
            "status"                    => VendorOffer::$confirm_status,
        ]);
        $vendorOffer->refresh();
        return $vendorOffer;
    }
    public static function counterOffer(VendorOffer $vendorOffer, $guard = "web")
    {
        $status = VendorOffer::$cancelled_status_vendor;
        if (CommonService::isFactory()) {
            if (auth($guard)->user()->id !== $vendorOffer->factory_id) {
                Log::alert('Permission denied counter offer factory');

                throw new PermissionDenied(self::$permision_denied_mesage, 401);
            }

        } elseif (CommonService::isHeadQuarter()) {
            $vendor_belongs_to_factory = FactoryInformation::where("headquarter_id", auth($guard)->id())
                ->where("user_id", $vendorOffer->factory_id)
                ->exists();
            if (!$vendor_belongs_to_factory) {
                Log::alert('Permission denied counter offer headquarter');
                throw new PermissionDenied("You dont have permission to counter offer.", 401);
            }
        }
        $status = VendorOffer::$counter_offer;
        return $vendorOffer->update([
            "counter_offer_price"      => request("counter_price"),
            "counter_offer_sent_at"    => now()->format("Y-m-d H:i:s"),
            "counter_offer_sent_by_id" => auth($guard)->id(),
            "counter_offer_sent_type"  => get_class(auth($guard)->user()),
            "status"                   => $status,
        ]);
    }
    public static function counterOfferVendor(VendorOffer $vendorOffer, $guard = "web")
    {
        if (auth($guard)->user()->id !== $vendorOffer->vendor_id) {
            Log::alert('Permission denied counter offer factory');

            throw new PermissionDenied(self::$permision_denied_mesage, 401);
        }
        $status = VendorOffer::$pending_status;
        return $vendorOffer->update([
            "offer_price"              => request("counter_price"),
            "status"                   => $status,
        ]);
    }
    public static function cancelOffer(VendorOffer $vendorOffer, $guard = "web")
    {
        $status = VendorOffer::$cancelled_status_vendor;
        if (CommonService::isFactory()) {
            if (auth($guard)->user()->id !== $vendorOffer->factory_id) {
                Log::alert('Permission denied confirm order factory');

                throw new PermissionDenied(self::$permision_denied_mesage, 401);
            }
            $status = VendorOffer::$cancelled_status_factory;

        } elseif (CommonService::isHeadQuarter()) {
            $vendor_belongs_to_factory = FactoryInformation::where("headquarter_id", auth($guard)->id())
                ->where("user_id", $vendorOffer->factory_id)
                ->exists();
            if (!$vendor_belongs_to_factory) {
                Log::alert('Permission denied confirm order headquarter');
                throw new PermissionDenied(self::$permision_denied_mesage, 401);
            }
            $status = VendorOffer::$cancelled_status_factory;
        }
        $confirmation_no = "NA";
        $vendorOffer->update([
            "cancelled_at"      => now()->format("Y-m-d H:i:s"),
            "cancelled_by_id"   => auth($guard)->id(),
            "cancelled_by_type" => get_class(auth($guard)->user()),
            "confirmation_code" => $confirmation_no,
            "status"            => $status,
        ]);
        $vendorOffer->refresh();
        return $vendorOffer;
    }
    public static function acceptOffer(VendorOffer $vendorOffer, $guard = "web")
    {
        $status = VendorOffer::$confirm_status;

        // if ($vendorOffer->status != VendorOffer::$counter_offer) {
        //     throw new PermissionDenied("Offer accept option not available.", 401);
        // }
        $confirmation_no = date("Y") . (10000 + $vendorOffer->id);
        $vendorOffer->update([
            "counter_offer_accepted_at" => now()->format("Y-m-d H:i:s"),
            "confirmed_price"           => $vendorOffer->counter_offer_price,
            "confirmation_code"         => $confirmation_no,
            "status"                    => $status,
        ]);
        $vendorOffer->refresh();
        return $vendorOffer;
    }
    public static function rejectBySupplierOffer(VendorOffer $vendorOffer, $guard = "web")
    {
        $status                 = VendorOffer::$rejected_by_supplier;
        $status_only_for_reject = [
            VendorOffer::$confirm_status,
            VendorOffer::$counter_offer,
        ];
        if (!in_array($vendorOffer->status, $status_only_for_reject)) {
            throw new PermissionDenied("Reject option not available for the offer.", 1);
        }

        $confirmation_no = "NA";
        $vendorOffer->update([
            "counter_offer_rejected_at" => now()->format("Y-m-d H:i:s"),
            "confirmation_code"         => $confirmation_no,
            "cancelled_reason"          => request("remark"),
            "status"                    => $status,
        ]);
        $vendorOffer->refresh();
        return $vendorOffer;

    }
    public static function fetchVendorOfferByConfirmationCode(String $confirmation_code, String $guard)
    {
        return VendorOffer::latest()->where("confirmation_code", $confirmation_code)->first();

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
        $builder->when(request("offer_status_not"), function ($query) {
            return $query->where("status", "!=", request("offer_status_not"));
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
        $builder->when(request("factory"), function ($query) {
            return $query->where("factory_id", request("factory"));
        });

        return $builder;
    }

    public static function todaysCollection($guard = "web")
    {
        $query = VendorOffer::whereDate("created_at", date("Y-m-d"));
        $query->when(auth($guard)->user()->isHeadquarter(), function ($query) use ($guard) {
            return $query->whereIn("factory_id", function ($query) use ($guard) {
                return $query->select("user_id")->from("factory_information")->where("headquarter_id", auth($guard)->id());
            });
        });
        $query->when(auth($guard)->user()->isFactory(), function ($query) use ($guard) {
            return $query->where("factory_id", auth($guard)->id());
        });
        $query->when(auth($guard)->user()->isVendor(), function ($query) use ($guard) {
            return $query->where("vendor_id", auth($guard)->id());
        });
        return $query->sum("net_weight");
    }
}
