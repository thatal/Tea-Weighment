<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyFineLeafCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_fine_leaf_counts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('headquarter_id');
            $table->unsignedBigInteger('factory_id')->nullable();
            $table->float('fine_leaf_count_from')->default(0.00);
            $table->float('fine_leaf_count_to')->default(0.00);
            $table->float('price')->default(0.00);
            $table->date('date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_fine_leaf_counts');
    }
}
