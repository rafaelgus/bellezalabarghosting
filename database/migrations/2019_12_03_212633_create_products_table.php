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
            $table->bigIncrements('id');
            $table->string('title', 100);
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->bigInteger('poll_id')->unsigned()->nullable();
            $table->bigInteger('empaque_id')->unsigned()->nullable();
            $table->json('attributes')->nullable();
            $table->json('how_to')->nullable();
            $table->string('slug', 100)->default('');
            $table->integer('general_reviews')->unsigned()->nullable();
            $table->integer('count_total_reviews')->unsigned()->nullable();
            $table->text('description', 150);
            $table->double('stock', 15, 8)->nullable()->default(0);
            $table->string('image')->nullable();
            $table->enum('status', ['PUBLICADO', 'BORRADOR', 'INACTIVO'])->default('BORRADOR');
            $table->date('date');
            $table->boolean('featured')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
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
