<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Models\DailyFineLeafCount;
use App\Models\Factory;
use Log;
use Validator;

class FineLeafController extends Controller
{
    public function index()
    {
        return view("factory.fine-leaf-count.index");
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
        $factory  = Factory::with("factory_information")->find(auth()->id());
        $data = [
            "headquarter_id"       => $factory->factory_information->headquarter_id,
            "factory_id"           => $factory->id,
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
        $records = DailyFineLeafCount::today()->factoryFilter()->orderBy("fine_leaf_count_from", "DESC")->get();
        return view("factory.fine-leaf-count.ajax-data", compact("records"));
    }

    public function edit(DailyFineLeafCount $model)
    {
        $model->leaf_count_from = $model->fine_leaf_count_from;
        $model->leaf_count_to = $model->fine_leaf_count_to;
        if(!$this->permissionToEdit($model)){
            return "Permission Denied.";
        }
        return view("factory.fine-leaf-count.edit", compact("model"));
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
                ->with("error", "You don't have permission to deactivate the record.");
        }
        try {
            $model->update([
                "deleted_at"    => now()->format("Y-m-d H:i:")
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()
            ->json([
                "message" => "failed"
            ], 403);
            return redirect()
                ->back()
                ->with("error", "Whoops! Something went wrong. try again later.");
        }
        return response()
        ->json([
            "message" => "Successfully Updated."
        ]);
        return redirect()
            ->back()
            ->with("success", "Successfully Deactivated.");

    }
    public function activate(DailyFineLeafCount $model)
    {

        if (!$this->permissionToDelete($model)) {
            return redirect()
                ->back()
                ->with("error", "You don't have permission to activate the record.");
        }
        try {
            $model->update([
                "deleted_at"    => null
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()
            ->json([
                "message" => "failed"
            ], 402);
            return redirect()
                ->back()
                ->with("error", "Whoops! Something went wrong. try again later.");
        }
        return response()
        ->json([
            "message" => "Successfully Updated."
        ]);
        return redirect()
            ->back()
            ->with("success", "Successfully Activated.");

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
        if(auth()->id() !== $record->factory_id){
            return false;
        }
        return true;
    }
    private function permissionToDelete(DailyFineLeafCount $record){
        return $this->permissionToEdit($record);
    }
}
