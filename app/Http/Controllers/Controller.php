<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectAsRole(){
        $role = auth()->user()->role;
        if($role =="admin"){
            return redirect()->route("admin.dashboard");
        }elseif($role =="headquarter"){
            return redirect()->route("headquarter.dashboard");
        }elseif($role =="factory"){
            return redirect()->route("factory.dashboard");
        }
    }
}
