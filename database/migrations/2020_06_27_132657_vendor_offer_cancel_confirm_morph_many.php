<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VendorOfferCancelConfirmMorphMany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            // $table->renameColumn('confirmed_by_id', 'to');
            $table->string('confirmed_by_type', 100)->nullable()->after("confirmed_by_id");
            $table->unsignedBigInteger('cancelled_by_id')->nullable()->after("confirmed_by_type");
            $table->string('cancelled_by_type')->nullable()->after("cancelled_by_id");
            $table->dateTime('cancelled_at')->nullable()->after("cancelled_by_type");
            $table->dateTime('cancelled_reason')->nullable()->after("cancelled_at");
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
            $table->dropColumn(["confirmed_by_type", "cancelled_by_id", "cancelled_by_type", "cancelled_at", "cancelled_reason"]);
        });
    }
}
