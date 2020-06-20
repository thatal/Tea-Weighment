<?php

use App\Models\VendorOffer;
use Illuminate\Database\Seeder;

class VendorOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(VendorOffer::class, 10)->create();
    }
}
