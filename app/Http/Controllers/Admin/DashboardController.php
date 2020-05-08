<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
