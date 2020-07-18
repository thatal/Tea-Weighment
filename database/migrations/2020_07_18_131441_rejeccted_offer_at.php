<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RejecctedOfferAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
           $table->dateTime('counter_offer_rejected_at')->nullable()->after("counter_offer_accepted_at");
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
            $table->dropColumn('counter_offer_rejected_at');
        });
    }
}
