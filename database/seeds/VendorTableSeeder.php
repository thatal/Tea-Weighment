<?php

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::where("role", Vendor::$role)->delete();
        DB::beginTransaction();
        try {
            $user = [
                "name"  => "Demo Vendor",
                "email" => "demo@vendor.com",
                "username"   => 'demo_1',
                "password"   => bcrypt("password")
            ];
            $vendor_info = [
                "mobile"    => "8888888888"
            ];
            $vendor_address = [
                "address_1" => "",
            ];
            $vendor_bank = [
                "bank_name" => "SBI",
                "account_number" => "312312312312",
                "account_holder_name" => "Demo Vendor Name",
                "ifsc_code" => "SBIN000123",
                "is_primary" => 1,
            ];
            $vendor = Vendor::create($user);
            $vendor->address()->create($vendor_address);
            $vendor->vendor_information()->create($vendor_info);
            $vendor->bank_details()->create($vendor_bank);
        } catch (\Throwable $th) {
            DB::rollback();
            throw new Exception($th->getMessage(), 441);
        }

        DB::commit();
    }
}
