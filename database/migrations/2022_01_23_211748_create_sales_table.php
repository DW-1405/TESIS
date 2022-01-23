<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedDecimal('code', 15, 2);
            $table->unsignedInteger("client_id");
            $table->foreign('client_id')->references("id")->on("clients")->onDelete("cascade");
            $table->unsignedInteger("user_id");
            $table->foreign('user_id')->references("id")->on("users")->onDelete("cascade");
            $table->unsignedInteger("voucher_type_id");
            $table->foreign('voucher_type_id')->references("id")->on("voucher_types")->onDelete("cascade");
            $table->unsignedDecimal('total', 15, 2);
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
        Schema::dropIfExists('sales');
    }
}
