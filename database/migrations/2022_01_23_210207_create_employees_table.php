<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->unsignedInteger("document_type_id");
            $table->foreign('document_type_id')->references("id")->on("document_types")->onDelete("cascade");
            $table->unsignedDecimal('number_document', 15, 2);
            $table->date('date_birth');  
            $table->string('email');
            $table->string('telephone');
            $table->string('address');  
            $table->unsignedInteger("workstation_id");
            $table->foreign('workstation_id')->references("id")->on("workstations")->onDelete("cascade");
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
        Schema::dropIfExists('employees');
    }
}
