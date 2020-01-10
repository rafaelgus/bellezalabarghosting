<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_name', 45)->nulable();
            $table->string('user_email', 45)->nulable();
            $table->string('user_cap', 20)->nulable();
            $table->string('user_direccion', 150)->nulable();
            $table->string('user_calle', 45)->nulable();
            $table->string('user_numero', 45)->nulable();
            $table->string('user_piso', 45)->nulable();
            $table->string('user_depto', 45)->nulable();
            $table->string('user_referencia', 150)->nulable();
            $table->string('user_localidad', 45)->nulable();
            $table->string('user_provincia', 45)->nulable();
            $table->string('request_track', 45)->nulable();
            $table->date('request_date', 45)->nulable();
            $table->enum('request_status', ['En Proceso','Aprobada', 'Enviada', 'Cancelada'])->default('En Proceso');
            $table->string('send_status', 45)->nulable();
            $table->date('send_date', 45)->nulable();
            $table->string('user_num_telf', 45)->nulable();
            $table->bigInteger('product_id')->unsigned();
            $table->string('product_name')->nulabe();
            $table->integer('qnt_request')->unsigned();
            $table->enum('review_completed', ['si','no'])->default('no');
            $table->enum('label_printed', ['si','no'])->default('no');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_requests');
    }
}
