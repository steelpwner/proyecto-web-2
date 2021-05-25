<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencia', function (Blueprint $table) {
            $table->id();
            //$table->string("nombre_acompañante");
            //$table->string("telefono_acompañante");
            $table->longtext("acompañante");
            $table->string("antecedentes_medicos")->nullable();
            $table->longtext("motivos_consulta");
            $table->longtext("sintomas");
            $table->string("diagnostico_doctor");
            $table->unsignedBigInteger("paciente");
            $table->foreign("paciente")->references("id")->on("paciente");
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
        Schema::dropIfExists('incidencia');
    }
}
