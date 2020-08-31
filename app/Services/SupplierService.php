<?php
namespace App\Services;

use App\Models\Vendor;

class SupplierService
{
    public function getAllSuppllierUsingFilter(array $with = [])
    {
        // vendor supplier same
        return Vendor::globalFilter()->with($with)->get();
    }
}
