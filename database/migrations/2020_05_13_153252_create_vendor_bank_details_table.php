<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_bank_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->comment("vendor id is belongs to user type vendor");
            $table->string('bank_name', 100);
            $table->string('account_number', 100);
            $table->string('account_holder_name', 100);
            $table->string('ifsc_code', 100);
            $table->tinyInteger('is_primary');
            $table->text('remarks')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_bank_details');
    }
}
