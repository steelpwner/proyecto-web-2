<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    //
    protected $table = "doctor";
    protected $fillable = ["nombre_completo","direccion","telefono","tipo_sangre","años_experiencia","fecha_nacimiento","hospital"];

}
