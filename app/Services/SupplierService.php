<?php
namespace App\Services;

use App\Models\Vendor;

class SupplierService
{
    public function getAllSuppllierUsingFilter(array $with = [], $select = [])
    {
        // vendor supplier same
        return Vendor::select($select ? $select : "*")->globalFilter()->with($with)->get();
    }
}
