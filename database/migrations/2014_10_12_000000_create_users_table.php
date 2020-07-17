<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('password', 191);
            $table->string('address', 191)->nullable();
            $table->string('avatar', 191)->nullable();
            $table->integer('admin')->nullable()->default(0);
            $table->integer('create_product')->nullable()->default(0);
            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);
            $table->integer('total_points')
                ->nullable()
                ->default(0);
            $table->integer('points_thicong')
                ->nullable()
                ->default(0);
            $table->integer('points_vattu')
                ->nullable()
                ->default(0);
            $table->integer('total_order')
                ->nullable()
                ->default(0);
            $table->integer('active')->nullable()->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}