<?php

namespace App\Http\Controllers\Factory;

use App\Http\Controllers\Controller;
use App\Services\SupplierService;

class VendorController extends Controller
{
    public $supplierService;
    public function __construct()
    {
        $this->supplierservice = new SupplierService();
    }
    public function index()
    {
        $suppliers = $this->supplierservice->getAllSuppllierUsingFilter(["address", "vendor_information", "bank_details"]);
        return view("headquarter.supplier.index", compact("suppliers"));

    }
}
