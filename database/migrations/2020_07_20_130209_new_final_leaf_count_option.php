<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewFinalLeafCountOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_offers', function (Blueprint $table) {
            $table->bigInteger('daily_leaf_cound_id')->nullable()->after("confirmed_fine_leaf_count");
            $table->float('final_rate', 10,2)->after("confirmed_fine_leaf_count")->default(0.00)->after("daily_leaf_cound_id");
            $table->bigInteger('leaf_count_added_by_id')->nullable()->after("final_rate");
            $table->dateTime('leaf_count_added_at')->nullable()->after("leaf_count_added_by_id");
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
            $table->dropColumn('daily_leaf_cound_id', "final_rate", "leaf_count_added_by_id", "leaf_count_added_at");
        });

    }
}
