<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('confirmation_code', 50)->nullable();
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('factory_id')->unsigned();
            $table->float('leaf_quantity', 10,3)->default(0.000);
            $table->float('offer_price', 10,2)->default(0.00);
            $table->string('expected_fine_leaf_count', 10)->default(0);
            $table->string('expected_moisture', 100)->default(0);
            $table->string('confirmed_moisture', 100)->default(0);
            $table->string('vehicle_number', 100)->nullable();
            $table->bigInteger('vehicle_type_id')->nullable();

            $table->float('first_weight', 20,3)->default(0.000);
            $table->string('first_weight_image', 100)->nullable();
            $table->float('second_weight', 20,3)->default(0.000);
            $table->string('second_weight_image', 100)->nullable();
            $table->float('tare', 20,3)->default(0.000);
            $table->float('deduction', 20,3)->default(0.000);
            $table->float('net_weight', 20,3)->default(0.000);

            $table->float('confirmed_price', 10,2)->default(0.00);
            $table->string('confirmed_fine_leaf_count', 10)->default(0);
            $table->float('total_amount', 20,2)->default(0.00);
            $table->string('status', 100)->default('pending');
            $table->softDeletes();
            $table->timestamps();
            $table->index(['confirmation_code', "vendor_id", "factory_id"], "indexing_all");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_offers');
    }
}
