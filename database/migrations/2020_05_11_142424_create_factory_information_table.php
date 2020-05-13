<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('headquarter_id');
            $table->string('mobile', 20)->nullable();
            $table->string('location', 255)->nullable();
            $table->tinyInteger('is_available')->defatul(true);
            $table->timestamps();
            $table->index(['headquarter_id', "user_id"],"fa_head_for");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factory_information');
    }
}
