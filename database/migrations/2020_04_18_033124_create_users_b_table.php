<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_b', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id_a')->unsigned();
            $table->foreign('user_id_a')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_id_b')->unsigned();
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
        Schema::dropIfExists('users_b');
    }
}