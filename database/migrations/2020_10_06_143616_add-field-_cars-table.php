<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
          $table->foreign('id_marka')->references('id')->on('marka');
          $table->foreign('id_model')->references('id')->on('model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
          $table->dropForeign('cars_id_marka_foreign');
          $table->dropForeign('cars_id_model_foreign');
        });
    }
}
