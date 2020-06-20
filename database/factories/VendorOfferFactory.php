<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Factory;
use App\Models\Vendor;
use App\Models\VendorOffer;
use Faker\Generator as Faker;

$factory->define(VendorOffer::class, function (Faker $faker) {
    return [
        "vendor_id" => Vendor::inRandomOrder()->first()->id,
        "factory_id" => Factory::inRandomOrder()->first()->id,
        "offer_price" => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50000),
        "expected_fine_leaf_count" => $faker->randomNumber($nbDigits = 3, $strict = false),
        "expected_moisture" => $faker->randomNumber($nbDigits = 3, $strict = false),
        "leaf_quantity" => $faker->randomNumber($nbDigits = 4, $strict = false),
    ];
});
