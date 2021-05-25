<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor', function (Blueprint $table) {
            $table->id();
            $table->string("nombre_completo");
            $table->string("direccion");
            $table->string("telefono");
            $table->string("tipo_sangre");
            $table->integer("años_experiencia");
            $table->date("fecha_nacimiento");
            $table->unsignedBigInteger('hospital');
            $table->foreign("hospital")->references("id")->on("hospital");
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
        Schema::dropIfExists('doctor');
    }
}
