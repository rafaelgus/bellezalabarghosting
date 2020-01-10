<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_restrictions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned();
            $table->string('sexo', 45)->nulable();
            $table->string('rangoEdadInicio', 45)->nulable();
            $table->string('rangoEdadFin', 45)->nulable();
            $table->string('cabelloTipo', 45)->nulable();
            $table->string('cremaCuerpo', 45)->nulable();
            $table->string('maquillajeUso', 45)->nulable();
            $table->string('rostroUso', 45)->nulable();
            $table->string('solarUso', 45)->nulable();
            $table->string('tinturaUso', 45)->nulable();
            $table->string('cabellocolNatural', 45)->nulable();
            $table->string('cabellocolActual', 45)->nulable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_restrictions');
    }
}
