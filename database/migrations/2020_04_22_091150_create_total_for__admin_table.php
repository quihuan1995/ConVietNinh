<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalForAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_for__admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('points_vattu')->default(0);
            $table->integer('points_thicong')->default(0);
            $table->integer('total_points')->default(0);
            $table->integer('total_order')->default(0);
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
        Schema::dropIfExists('total_for__admin');
    }
}
