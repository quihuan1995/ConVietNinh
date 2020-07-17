<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_c', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id_b')->unsigned();
            $table->foreign('user_id_b')->references('id')->on('users_b')->onDelete('cascade');
            $table->integer('user_id_c')->unsigned();
            $table->string('name', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('password', 191);
            $table->string('address', 191)->nullable();
            $table->string('avatar', 191)->nullable();
            $table->tinyInteger('state')->unsigned();
            $table->dateTime('date_in')->nullable()->default(null);
            $table->dateTime('date_out')->nullable()->default(null);
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
        Schema::dropIfExists('users_c');
    }
}