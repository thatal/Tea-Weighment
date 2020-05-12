<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view("factory.dashboard");
    }
}
