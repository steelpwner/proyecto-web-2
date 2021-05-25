<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    //
    protected $table="incidencia";
    protected $fillable=["acompañante","antecedentes_medicos","motivos_consulta","sintomas","diagnostico_doctor","paciente"];
}
