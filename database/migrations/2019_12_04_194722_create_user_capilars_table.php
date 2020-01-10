<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCapilarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_capilars', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('shampu_uso', 10)->nulable();
            $table->bigInteger('user_id')->unsigned();
            $table->string('acondicionador_uso', 190)->nulable();
            $table->string('crema_peinar_uso', 190)->nulable();
            $table->string('tratamiento_pote_uso', 190)->nulable();
             $table->string('trata_esp_uso', 190)->nulable();
            $table->string('gel_spray_uso', 190)->nulable();
            $table->string('cabello_tipo', 190)->nulable();
            $table->json('capilar_marcas', 190)->nulable();
            $table->json('cabello_problema')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('user_capilars');
    }
}
