<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger("document_type_id");
            $table->foreign('document_type_id')->references("id")->on("document_types")->onDelete("cascade");
            $table->unsignedDecimal('number_document', 15, 2);
            $table->unsignedDecimal('telephone', 15, 2);
            $table->string('address');
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
        Schema::dropIfExists('clients');
    }
}
