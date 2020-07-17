<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('images_product', 191);
            $table->string('name_product', 191);
            $table->integer('price_product');
            $table->integer('is_sale')->nullable()->default(0);
            $table->integer('price_product_sale')->nullable()->default(0);
            $table->integer('quantity')->nullable()->default(0);
            $table->dateTime('start_discount')->nullable()->default(null);
            $table->dateTime('stop_discount')->nullable()->default(null);
            $table->string('type_product', 191);
            $table->string('menu_id', 191);
            $table->string('sku', 191);
            $table->string('content', 191);
            $table->integer('active')->default(1);
            $table->integer('categories_id')->unsigned();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}