<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name')->nullable();
            $table->string('addrees')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('img_customer');
            $table->decimal('total', 18, 0)->nullable();
            $table->tinyInteger('state')->unsigned();
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
        Schema::dropIfExists('customer');
    }
}