<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalidadeProductRestrictionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidades_product_restriction', function (Blueprint $table) {
            $table->integer('localidad_id')->unsigned()->index();
            $table->foreign('localidad_id')->references('id')->on('localidades')->onDelete('cascade');
            $table->bigInteger('restric_id')->unsigned()->index();
            $table->foreign('restric_id')->references('id')->on('product_restrictions')->onDelete('cascade');
            $table->primary(['localidad_id', 'restric_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localidade_product_restriction');
    }
}
