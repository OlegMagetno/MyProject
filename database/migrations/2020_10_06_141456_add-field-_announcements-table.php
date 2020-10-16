<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcements', function (Blueprint $table) {
          $table->foreign('id_owners')->references('id')->on('owners');
          $table->foreign('id_cars')->references('id')->on('cars');
          $table->foreign('id_attributes')->references('id')->on('attributes');
          $table->foreign('id_addresses')->references('id')->on('addresses');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
          $table->dropForeign('announcements_id_owners_foreign');
          $table->dropForeign('announcements_id_cars_foreign');
          $table->dropForeign('announcements_id_attributes_foreign');
          $table->dropForeign('announcements_id_addresses_foreign');

        });
    }
}
