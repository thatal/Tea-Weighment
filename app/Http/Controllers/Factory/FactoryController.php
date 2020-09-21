<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Illuminate\Http\Request;
use Log;
use Validator;

class FactoryController extends Controller
{
    public function vendorOffers()
    {
        if(request("export") === "excel"){
            return VendorOfferService::all();
        }
        $vendor_offers = VendorOfferService::all();
        // dd($vendor_offers);
        return view("factory.reports.vendor-offers", compact("vendor_offers"));
    }

    public function summaryReport()
    {
        $summary_reports = VendorOfferService::summaryReport();
        // return $summary_reports;
        return view("factory.reports.summary-vendor-offers", compact("summary_reports"));

    }
    public function addPriceToVendorOffer(VendorOffer $vendor_offer)
    {
        $user      = auth()->user();
        $validator = Validator::make(request()->all(), $this->priceRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with("error", "Please fix the issues. " . implode(", ", $validator->errors()->all()));
        }
        try {
            $vendor_offer->confirmed_fine_leaf_count = request("leaf_count");
            $vendor_offer->final_rate                = request("price");
            $vendor_offer->leaf_count_added_by_id    = $user->id;
            $vendor_offer->leaf_count_added_at       = now()->format("Y-m-d H:i:s");
            // $vendor_offer->deduction = ($vendor_offer->net_weight /100) * $vendor_offer->confirmed_moisture;
            $vendor_offer->total_amount = (request("price") * $vendor_offer->net_weight);

            $vendor_offer->save();
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whops! something went wrong. try again later.");

        }
        return redirect()->back()
            ->with("success", "Successfully Price Added.");
    }

    private function priceRules()
    {
        return [
            "leaf_count" => "required|numeric|min:1|max:100",
            "price"      => "required|numeric",
        ];
    }
}
