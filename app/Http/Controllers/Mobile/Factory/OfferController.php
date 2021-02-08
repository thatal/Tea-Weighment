<?php

namespace App\Http\Controllers\Mobile\Factory;

use App\Http\Controllers\Controller;
use App\Models\VendorOffer;
use App\Services\VendorOfferService;
use Log;
use Validator;

class OfferController extends Controller
{
    private $guard    = "sanctum";
    private $paginate = 100;
    public function index()
    {
        try {
            $all_offers = VendorOfferService::all($this->paginate, $this->guard);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => "Whoops! Something went wrong.",
                "data"    => [],
                "status"  => false,
            ]);

        }

        return response()->json([
            "message" => $all_offers->total() . " records found ",
            "data"    => $all_offers,
            "status"  => true,
        ]);
    }
    public function confirmationFetch()
    {
        $validator = Validator::make(request()->all(), $this->confirmationFetchRule());
        if ($validator->fails()) {
            return response()->json([
                "message" => "Validation error.",
                "status"  => false,
                "data"    => $validator->errors(),
            ]);
        }
        $confirmation_code = request("confirmation_code");
        $vendor_offer      = VendorOfferService::fetchVendorOfferByConfirmationCode($confirmation_code, $this->guard);
        if (!$vendor_offer) {
            return response()->json([
                "message" => "Offer not found in your database.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        if ($vendor_offer->factory_id !== auth("sanctum")->id()) {
            return response()->json([
                "message" => "Confirmation code does not belongs to your factory.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        return response()->json([
            "message" => "Vendor offer found.",
            "status"  => true,
            "data"    => $vendor_offer,
        ]);

    }
    public function firstWeightDataSave()
    {
        $validator = Validator::make(request()->all(), $this->firstWeightRule());
        if ($validator->fails()) {
            return response()->json([
                "message" => "Validation error.",
                "status"  => false,
                "data"    => $validator->errors(),
            ]);
        }
        $confirmation_code = request("confirmation_code");
        $vendor_offer      = VendorOfferService::fetchVendorOfferByConfirmationCode($confirmation_code, $this->guard);
        if (!$vendor_offer) {
            return response()->json([
                "message" => "Offer not found in your database.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        if ($vendor_offer->factory_id !== auth("sanctum")->id()) {
            return response()->json([
                "message" => "Confirmation code does not belongs to your factory.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        if ($vendor_offer->status !== VendorOffer::$confirm_status) {
            return response()->json([
                "message" => "Offer not ready or closed for first weight.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        try {
            $file  = request()->file("gross_weight_image");
            $fname = time() . "_" . rand(0, 265894561) . '.' . $file->getClientOriginalExtension();

            $directory = "uploads/" . auth($this->guard)->id() . "/" . $confirmation_code . "/";

            $filename = $directory . $fname;
            $file->move(storage_path("app/public/" . $directory), $fname);
            // $full_url_filename =  url() . "/" . $filename;

            $vendor_offer->vehicle_type_id    = request("vehicle_type_id");
            $vendor_offer->vehicle_number     = request("vehicle_number");
            $vendor_offer->first_weight       = request("gross_weight");
            $vendor_offer->deduction          = request("deduction") ?? 0;
            $vendor_offer->confirmed_moisture = request("moisture") ?? 0;
            $vendor_offer->first_weight_image = $filename;
            $vendor_offer->status             = VendorOffer::$first_wieght_status;
            $vendor_offer->slip_number        = request("slip_number");
            $vendor_offer->vehicle_in_time    = request("vehicle_in_time");
            $vendor_offer->save();
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => "Whoops! data save failed. try again later.",
                "status"  => false,
                "data"    => [],
            ]);

        }
        return response()->json([
            "message" => "Gross Weight data successfully saved.",
            "status"  => true,
            "data"    => $vendor_offer,
        ]);

    }
    public function secondWeightDataSave()
    {
        $validator = Validator::make(request()->all(), $this->secondWeightRule());
        if ($validator->fails()) {
            return response()->json([
                "message" => "Validation error.",
                "status"  => false,
                "data"    => $validator->errors(),
            ]);
        }
        $confirmation_code = request("confirmation_code");
        $vendor_offer      = VendorOfferService::fetchVendorOfferByConfirmationCode($confirmation_code, $this->guard);
        if (!$vendor_offer) {
            return response()->json([
                "message" => "Offer not found in your database.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        if ($vendor_offer->factory_id !== auth("sanctum")->id()) {
            return response()->json([
                "message" => "Confirmation code does not belongs to your factory.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        if ($vendor_offer->status !== VendorOffer::$first_wieght_status) {
            return response()->json([
                "message" => "Offer not ready or closed for second weight.",
                "status"  => false,
                "data"    => [],
            ]);
        }
        try {
            $file  = request()->file("second_weight_image");
            $fname = time() . "_" . rand(0, 265894561) . '.' . $file->getClientOriginalExtension();

            $directory = "uploads/" . auth($this->guard)->id() . "/" . $confirmation_code . "/";

            $filename = $directory . $fname;
            $file->move(storage_path("app/public/" . $directory), $fname);
            // $full_url_filename =  url() . "/" . $filename;
            $temp_net_weight                        = $vendor_offer->first_weight - request("second_weight");
            $deduction                         = round(($temp_net_weight / 100) * $vendor_offer->confirmed_moisture, 2);


            $vendor_offer->second_weight       = request("second_weight");
            $vendor_offer->confirmed_fine_leaf_count = request("fineLeafCount");
            $vendor_offer->second_weight_image = $filename;
            $vendor_offer->status              = VendorOffer::$second_wieght_status;
            $vendor_offer->net_weight          = round($temp_net_weight - $deduction, 2);
            $vendor_offer->deduction           = $deduction;
            $vendor_offer->vehicle_out_time    = request("vehicle_out_time");
            $vendor_offer->save();
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                "message" => "Whoops! data save failed. try again later.",
                "status"  => false,
                "data"    => [],
            ]);

        }
        return response()->json([
            "message" => "Tare weight data successfully saved.",
            "status"  => true,
            "data"    => $vendor_offer,
        ]);

    }
    private function confirmationFetchRule()
    {
        return [
            "confirmation_code" => "required",
        ];
    }
    private function firstWeightRule()
    {
        return [
            "confirmation_code"  => "required",
            "vehicle_type_id"    => "required|exists:vehicles,id",
            "vehicle_number"     => "required|max:191",
            "gross_weight"       => "required|numeric|min:1",
            "gross_weight_image" => "required|image",
            "deduction"          => "numeric",
            "moisture"           => "numeric|required",
            "slip_number"        => "required|max:200",
            "vehicle_in_time"    => "required|max:50|date_format:h:i A",
        ];
    }
    private function secondWeightRule()
    {
        return [
            "confirmation_code"   => "required",
            "second_weight"       => "required|numeric|min:1",
            "second_weight_image" => "required|image",
            "fineLeafCount"       => "required|numeric|min:1|max:100",
            "vehicle_out_time"    => "required|max:50|date_format:h:i A",
        ];
    }
}
