<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OfferSlipNoInOutTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->string('slip_number', 100)->nullable()->after("confirmation_code");
            $table->string('vehicle_in_time', 50)->nullable()->after("slip_number");
            $table->string('vehicle_out_time', 50)->nullable()->after("vehicle_in_time");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->dropColumn(["slip_number", "vehicle_in_time", "vehicle_out_time"]);
        });
    }
}
