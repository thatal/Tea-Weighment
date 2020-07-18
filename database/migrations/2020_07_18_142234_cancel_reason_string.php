<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CancelReasonString extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->dropNew();
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->text('cancelled_reason')->nullable()->after("cancelled_at");
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
            //
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function dropNew()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->dropColumn('cancelled_reason');
        });
    }
}
