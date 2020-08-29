<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HeadquarterIdAddedVendorInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_information', function (Blueprint $table) {
            $table->unsignedBigInteger('headquarter_id')->after("id")->default(0);
            /* $table->foreign('headquarter_id')
                ->references('id')
                ->on('users'); */
            $table->index('headquarter_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_information', function (Blueprint $table) {
            $table->dropColumn('headquarter_id');
        });
    }
}
