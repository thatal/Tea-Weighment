<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncentiveOnVendorOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->bigInteger('incentive_added_by_id')->nullable()->after("daily_leaf_count_id");
            $table->float('incentive_per_kg', 20, 2)->nullable()->after("incentive_added_by_id");
            $table->float('incentive_total', 20, 2)->nullable()->after("incentive_per_kg");
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
            $table->dropColumn(["incentive_added_by_id", "incentive_per_kg", "incentive_total"]);
        });
    }
}
