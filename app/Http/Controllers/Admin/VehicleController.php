<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Validator;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::paginate(50);
        return view("admin.vehicle.index", compact("vehicles"));
    }

    public function create()
    {
        return view("admin.vehicle.create");
    }
    public function store(Request $request)
    {
        $rules = Vehicle::rules();
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $request->session()->flash('error', "error");
            return redirect()
                ->back()
                ->with("error", "Verify and submit correct data.")
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $data = $request->only(["name", "weight"]);
        try {
            Vehicle::create($data);
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->with("error", "Whoops something went wrong try again later.");
        }
        return redirect()->back()->with("success", "Successfully added.");

    }
    public function destroy(Vehicle $vehicle)
    {
        try {
            $vehicle->delete();
        } catch (\Throwable $th) {
            \Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong. try again later.");
        }
        return redirect()
            ->back()
            ->with("success", "Successfully deleted.");
    }
    public function edit(Vehicle $vehicle)
    {
        return view("admin.vehicle.edit", compact("vehicle"));
    }
    public function update(Vehicle $vehicle, Request $request)
    {
        $rules = Vehicle::rules();
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            $request->session()->flash('error', "error");
            return redirect()
                ->back()
                ->with("error", "Verify and submit correct data.")
                ->withErrors($validator)
                ->withInput($request->all());
        }
        try {
            $vehicle->update([
                "name"  => $request->name,
                "weight"    => $request->weight
            ]);
        } catch (\Throwable $th) {
            \Log::error($th);
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong. try again later.");
        }
        return redirect()
            ->route("admin.vehicle.index")
            ->with("success", "Successfully updated.");
    }
}
