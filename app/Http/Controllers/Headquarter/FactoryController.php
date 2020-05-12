<?php

namespace App\Http\Controllers\Headquarter;

use App\Http\Controllers\Controller;
use App\Models\Factory;
use App\Services\FactoryServices;
use DB;
use Illuminate\Http\Request;
use Str;
use Validator;

class FactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factories = FactoryServices::index();
        return view("headquarter.factory.index", compact("factories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("headquarter.factory.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules     = Factory::rules();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->all());
        }
        $user_data    = $request->only(["name", "email", "password", "code"]);
        $address_data = $request->only(["address_1", "address_2", "pin"]);
        DB::beginTransaction();
        try {
            $user_data                             = $request->only(["name", "email", "password", "code"]);
            $address_data                          = $request->only(["address_1", "address_2", "pin"]);
            $factory_information                   = $request->only(["location", "mobile"]);
            $user_data["password"]                 = bcrypt($user_data["password"]);
            $user_data["username"]                 = $user_data["code"];
            $factory_information["headquarter_id"] = auth()->user()->id;
            $factory_information["is_available"]   = 0;
            // dump($address_data);
            // dd($user_data);
            $factory = Factory::create($user_data);
            $factory->address()->create($address_data);
            $factory->factory_information()->create($factory_information);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()
                ->back()
                ->with("error", "Whoops! something went wrong.");
        }
        DB::commit();
        return redirect()
            ->route("headquarter.factory.index")
            ->with("success", "Successfully added.");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Factory $factory)
    {
        return view("headquarter.factory.show", compact("factory"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Factory $factory)
    {
        if(!$factory->isFactoryOwner()){
            return redirect()
                ->route("headquarter.factory.index")
                ->with("error", "Access denied.");
        }
        $factory->load(["factory_information", "address"]);
        return view("headquarter.factory.edit", compact("factory"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factory $factory)
    {
        if(!$factory->isFactoryOwner()){
            return redirect()
                ->route("headquarter.factory.index")
                ->with("error", "Access denied.");
        }
        $validator = Validator::make($request->all(), $factory::updateRules());
        if ($validator->fails()) {
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
        $factory_info = $request->only([
            "mobile",
            "location",
        ]);
        DB::beginTransaction();
        try {
            $factory->update($user_data);
            $factory->address()->update($address_data);
            $factory->factory_information()->update($factory_info);
        } catch (\Throwable $th) {
            \Log::error($th);
            DB::rollback();
            return redirect()
                ->back()
                ->with("error", "Whoops! updation failed.");
        }
                DB::commit();
        return redirect()
            ->route("headquarter.factory.index")
            ->with("success", "Succcessfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factory $factory)
    {
        if(!$factory->isFactoryOwner()){
            return redirect()
                ->route("headquarter.factory.index")
                ->with("error", "Access denied.");
        }
        try {
            $factory->address()->delete();
            $factory->factory_information()->delete();
            $factory->delete();
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

    public function passwordReset(Factory $factory)
    {
        if(!$factory->isFactoryOwner()){
            return response()
                ->json([
                    "status"    => false,
                    "message"   => "Access denied."
                ]);
        }
        $dynamic_pass = Str::random(8);
        try {
            $factory->update([
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
