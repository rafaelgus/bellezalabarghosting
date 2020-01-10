<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductRestrictionProvinciaPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_restriction_provincia', function (Blueprint $table) {
            $table->bigInteger('restric_id')->unsigned()->index();
            $table->foreign('restric_id')->references('id')->on('product_restrictions')->onDelete('cascade');
            $table->integer('provincia_id')->unsigned()->index();
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
            $table->primary(['restric_id', 'provincia_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_restriction_provincia');
    }
}
