<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_id_b')->unsigned();
            $table->foreign('user_id_b')->references('id')->on('users_b')->onDelete('cascade');
            $table->integer('user_id_c')->unsigned();
            $table->foreign('user_id_c')->references('id')->on('users_c')->onDelete('cascade');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->string('img', 191);
            $table->string('name', 191);
            $table->string('order_status', 191);
            $table->string('total', 191);
            $table->string('addrees', 191);
            $table->integer('total_price_construction')->default(0);
            $table->integer('total_price')->default(0);
            $table->dateTime('order_date');
            $table->dateTime('order_start_date')->nullable()->default(null);
            $table->dateTime('order_complete_date')->nullable()->default(null);
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
        Schema::dropIfExists('order');
    }
}