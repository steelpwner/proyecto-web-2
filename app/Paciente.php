<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    protected $table = "paciente";
    protected $fillable = ["nombre","direccion","telefono","persona_contacto","eps","hospital"];
}
