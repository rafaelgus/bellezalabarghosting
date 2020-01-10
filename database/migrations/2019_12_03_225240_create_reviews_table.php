<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('country')->nullable();
            $table->string('coments')->nullable();
            $table->string('general_rating')->nullable();
            $table->string('presentacion')->nullable();
            $table->string('aroma')->nullable();
            $table->string('textura')->nullable();
            $table->string('durabilidad')->nullable();
            $table->string('fac_uso')->nullable();
            $table->string('eficacia')->nullable();
            $table->string('calidad_precio')->nullable();
            $table->string('compraria')->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->string('product_name', 100)->nullable()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('user_registered', 10)->nullable()->nullable();
            $table->tinyInteger('aproved')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
