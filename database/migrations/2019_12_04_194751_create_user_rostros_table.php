<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRostrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rostros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('cuidado_rostro_uso', 190)->nulable();
            $table->string('ros_jabn_comun', 190)->nulable();
            $table->string('ros_jabn_esp', 190)->nulable();
            $table->string('ros_desmaquillante', 190)->nulable();
            $table->string('ros_locion_tonico', 190)->nulable();
            $table->string('ros_crema_hidratante_rostro', 190)->nulable();
            $table->string('ros_crema_hidratante_cuerpo', 190)->nulable();
            $table->string('ros_prot_solar_rostro', 190)->nulable();
            $table->string('ros_prot_solar_cuerpo', 190)->nulable();
            $table->string('ros_crema_antiedad', 190)->nulable();
            $table->json('rostro_marcas')->nulable();
            $table->json('rostro_problemas')->nulable();
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
        Schema::dropIfExists('user_rostros');
    }
}
