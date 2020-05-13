<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        die("Hellow");
        return redirect()->route("admin.dashboard");
    }

    public function dasboard()
    {
        return view("admin.dashboard");
    }
}
