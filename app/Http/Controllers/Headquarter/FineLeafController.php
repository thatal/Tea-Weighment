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

    public function edit(DailyFineLeafCount $model)
    {
        $model->leaf_count_from = $model->fine_leaf_count_from;
        $model->leaf_count_to = $model->fine_leaf_count_to;
        return view("headquarter.fine-leaf-count.edit", compact("model"));
    }
    public function update(DailyFineLeafCount $model)
    {
        $validator = Validator::make(request()->all(), $this->storeRules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with("error", "Please fix the errors. ".implode(", ",$validator->errors()->all()))
                ->withErrors($validator)
                ->withInput(request()->all());
        }
        if (!$this->permissionToEdit($model)) {
            return redirect()
                ->back()
                ->with("error", "You don't have permission to edit the record.")
                ->withErrors($validator)
                ->withInput(request()->all());
        }
        $data = [
            "fine_leaf_count_from" => request("leaf_count_from"),
            "fine_leaf_count_to"   => request("leaf_count_to"),
            "price"                => request("price"),
            "date"                 => request("date"),
        ];
        try {
            $model->update($data);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! Something went wrong. try again later.");
        }
        return redirect()
            ->back()
            ->with("success", "Successfully Updated.");

    }
    public function destroy(DailyFineLeafCount $model)
    {

        if (!$this->permissionToDelete($model)) {
            return redirect()
                ->back()
                ->with("error", "You don't have permission to edit the record.");
        }
        try {
            $model->delete();
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! Something went wrong. try again later.");
        }
        return redirect()
            ->back()
            ->with("success", "Successfully Deleted.");

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
    private function permissionToEdit(DailyFineLeafCount $record){
        if(auth()->id() !== $record->headquarter_id){
            return false;
        }
        return true;
    }
    private function permissionToDelete(DailyFineLeafCount $record){
        return $this->permissionToEdit($record);
    }
}
