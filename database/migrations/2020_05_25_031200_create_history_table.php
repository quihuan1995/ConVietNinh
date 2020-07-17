<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->Increments('id');
            $table->dateTime('histories')->nullable();
            $table->tinyInteger('ImExPort')->unsigned();
            $table->integer('quantity')->nullable()->default(0);
            $table->decimal('price', 18, 0)->default(0);
            $table->decimal('total_price', 18, 0)->default(0);
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
        Schema::dropIfExists('history');
    }
}