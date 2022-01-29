<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->unsignedInteger("product_categories_id");
            $table->foreign('product_categories_id')->references("id")->on("product_categories")->onDelete("cascade");
            $table->unsignedDecimal('stock', 15, 2);
            $table->unsignedDecimal('unit_price', 15, 2);
            $table->unsignedInteger("brand_id");
            $table->foreign('brand_id')->references("id")->on("brands")->onDelete("cascade");
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
