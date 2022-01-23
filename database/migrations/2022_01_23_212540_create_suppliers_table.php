<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->unsignedInteger("document_type_id");
            $table->foreign('document_type_id')->references("id")->on("document_types")->onDelete("cascade");
            $table->unsignedDecimal('number_document', 15, 2);
            $table->string('telephone');
            $table->string('address');  
            $table->string('email'); 
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
        Schema::dropIfExists('suppliers');
    }
}
