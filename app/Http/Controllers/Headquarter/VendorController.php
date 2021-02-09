<?php

namespace App\Http\Controllers\Headquarter;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
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
    public function changeStatus (Vendor $vendor)
    {
        $vendor->show_slab = !$vendor->show_slab;
        $vendor->save();
        return redirect()
        ->back()
        ->with("success", "Status changed successfully");
    }
}
