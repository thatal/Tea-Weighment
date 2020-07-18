<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CounterOfferForVendorOffer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->float('counter_offer_price')->nullable()->default(0.00)->after("confirmed_price");
            $table->unsignedBigInteger('counter_offer_sent_by_id')->nullable()->after("counter_offer_price");
            $table->string('counter_offer_sent_type', 100)->nullable()->after("counter_offer_sent_by_id");
            $table->dateTime('counter_offer_sent_at')->nullable()->after("counter_offer_sent_type");
            $table->dateTime('counter_offer_accepted_at')->nullable()->after("counter_offer_sent_at")->comment("counter offer accepted or rejected at.");
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
            $table->dropColumn('counter_offer_price', "counter_offer_sent_by_id", "counter_offer_sent_type", "counter_offer_sent_at", "counter_offer_accepted_at");
        });
    }
}
