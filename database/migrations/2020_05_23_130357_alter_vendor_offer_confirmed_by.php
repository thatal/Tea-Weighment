<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVendorOfferConfirmedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->dateTime('confirmed_at')->nullable()->after("status");
            $table->bigInteger('confirmed_by_id')->unsigned()->nullable()->after("confirmed_at");
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
            $table->dropColumn(['confirmed_at', 'confirmed_by_id']);
        });
    }
}
