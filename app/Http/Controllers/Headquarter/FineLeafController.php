<?php

namespace App\Http\Controllers\Headquarter;

use App\Http\Controllers\Controller;
use App\Models\DailyFineLeafCount;
use Log;
use Validator;

class FineLeafController extends Controller
{
    public function index()
    {
        return view("headquarter.fine-leaf-count.index");
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), $this->storeRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with("error", "Please fix the errors.")
                ->withErrors($validator)
                ->withInput(request()->all());
        }
        $data = [
            "headquarter_id"       => auth()->id(),
            "fine_leaf_count_from" => request("leaf_count_from"),
            "fine_leaf_count_to"   => request("leaf_count_to"),
            "price"                => request("price"),
            "date"                 => request("date"),
        ];
        try {
            DailyFineLeafCount::create($data);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! Something went wrong. try again later.");
        }
        return redirect()
            ->back()
            ->with("success", "Successfully Created.");
    }
    public function ajaxData()
    {
        $records = DailyFineLeafCount::orderBy("fine_leaf_count_from", "DESC")->get();
        return view("headquarter.fine-leaf-count.ajax-data", compact("records"));
    }
    private function storeRules()
    {
        return [
            "leaf_count_from" => "required|min:1|max:100|numeric",
            "leaf_count_to"   => "required|min:1|max:100|numeric",
            "price"           => "required|min:1|numeric",
            "date"            => "required|date_format:Y-m-d",
        ];
    }
}
