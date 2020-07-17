<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_d', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id_c')->unsigned();
            $table->foreign('user_id_c')->references('id')->on('users_c')->onDelete('cascade');
            $table->integer('user_id_d')->nullable()->default(0);
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
        Schema::dropIfExists('users_d');
    }
}