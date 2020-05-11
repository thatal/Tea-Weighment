<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Headquarter;
use DB;
use Illuminate\Http\Request;
use Str;
use Validator;

class HeadQuarterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DB::listen(function($query){
        //     dump($query->sql);
        //     dump($query->bindings);
        // });
        $headquarters = Headquarter::with("address")->paginate(50);
        return view("admin.headquarters.index", compact("headquarters"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.headquarters.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Headquarter::rules();
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            dd($validator->errors());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $user_data = $request->only(["name", "email", "password", "code"]);
        $address_data = $request->only(["address_1", "address_2", "pin"]);
        DB::beginTransaction();
        try {
            $user_data = $request->only(["name", "email", "password", "code"]);
            $address_data = $request->only(["address_1", "address_2", "pin"]);
            $user_data["password"] = bcrypt($user_data["password"]);
            $user_data["username"] = $user_data["code"];
            // dump($address_data);
            // dd($user_data);
            $headquarter = Headquarter::create($user_data);
            $headquarter->address()->create($address_data);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong.");
        }
        DB::commit();
        return redirect()
            ->route("admin.headquarter.index")
            ->with("success", "Successfully added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Headquarter $headquarter)
    {
        return response()->view("admin.headquarters.show", compact("headquarter"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Headquarter $headquarter)
    {
        $headquarter->load("address");
        return view("admin.headquarters.edit", compact("headquarter"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Headquarter $headquarter)
    {
        $updateRules = Headquarter::updateRules();
        $validator = Validator::make($request->all(), $updateRules);
        if($validator->fails()){
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $user_data = $request->only([
            "email",
            "name",
        ]);
        $address_data = $request->only([
            "address_1",
            "address_2",
            "pin",
        ]);
        DB::beginTransaction();
        try {
            $headquarter->update($user_data);
            $headquarter->address->update($address_data);
        } catch (\Throwable $th) {

            \Log::error($th);
            DB::rollback();
            return redirect()
                ->back()
                ->with("error", "Whoops! updation failed.");
        }
        DB::commit();
        return redirect()
            ->route("admin.headquarter.index")
            ->with("success", "Succcessfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Headquarter $headquarter)
    {
        try {
            $headquarter->address()->delete();
            $headquarter->delete();
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
    public function passwordReset(Headquarter $headquarter)
    {
        $dynamic_pass = Str::random(8);
        try {
            $headquarter->update([
                "password" => bcrypt($dynamic_pass)
            ]);
        } catch (\Throwable $th) {
            \Log::error($th);
            return response()
                ->json([
                    "status"    => false,
                    "message"   => "Pasword reset faild."
                ]);
        }
        return response()
            ->json([
                "status"  => true,
                "message" => "Pasword reset successfully to {$dynamic_pass}",
            ]);

    }
}
