<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTinturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tinturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('tintura_uso', 190)->nulable();
            $table->string('tintura_frecuencia', 190)->nulable();
            $table->string('tintura_por_que', 190)->nulable();
            $table->json('tintura_marcas')->nulable();
            $table->string('cabellocol_natural', 190)->nulable();
            $table->string('cabellocol_actual', 190)->nulable();
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
        Schema::dropIfExists('user_tinturas');
    }
}
