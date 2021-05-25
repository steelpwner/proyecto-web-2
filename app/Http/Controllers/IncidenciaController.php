<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidencia;
use Illuminate\Support\Facades\DB;
use App\Paciente;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $incidencias = DB::table('incidencia')
                      ->join('paciente', 'paciente.id', '=', 'incidencia.paciente')
                      ->select("incidencia.*","paciente.nombre AS nombre_paciente")
                      ->get();
        return view("incidencia.list",["incidencias" => $incidencias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pacientes = Paciente::all();
        $sintomas = ["Tos","Dificultad para respirar","Fiebre","Escalofrios","Temblores y escalofrios que no ceden","Dolor muscular"];
        return view("incidencia.create",["sintomas"=>$sintomas,"pacientes"=>$pacientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        error_log('No se ha validado aún');
        error_log($request);
        $request->validate([
            "paciente" => "required",
            "nombre_a" => "required",
            "telefono_a" => "required",
            "antecedentes" => "required",
            "Tos" => "required",
            "Dificultad+para+respirar" => "required",
            "Fiebre" => "required",
            "Escalofrios" => "required",
            "Temblores+y+escalofrios+que+no+ceden" => "required",
            "Dolor+muscular" => "required",
            "motivos_consulta" => "required",
            "diagnostico_doctor" => "required"
        ]);
        error_log('Después de validar');
        $sintomas = ["Tos","Dificultad para respirar","Fiebre","Escalofrios","Temblores y escalofrios que no ceden","Dolor muscular"];
        $acompañante = json_encode(array("nombre"=>$request->get("nombre_a"), "telefono"=>$request->get("telefono_a")),JSON_UNESCAPED_UNICODE);
        $antecedentes = $request->get("antecedentes");
        if ($antecedentes == "si") {
            $antecedentes = $request->get("antecedentes-text");
            if ($antecentes == "") {
                $antecedentes = "No";
            }
        } else {
            $antecedentes = "No";
        }
        $s = [];
        $posible_enfermedad = False;
        $cantidad = 0;
        foreach ($sintomas as $sintoma) {
            error_log($sintoma);
            $valor = $request->get(str_replace(" ","+",$sintoma));
            error_log($valor);
            if ($valor == "si") {
                $cantidad = $cantidad + 1;
            }
            $s[$sintoma] = $valor;
        }
        if ($cantidad >= 2 || $s['Tos'] == "si" || $s['Dificultad para respirar'] == "si") {
            $posible_enfermedad = True;
        }
        $i = new Incidencia([
            "acompañante" => $acompañante,
            "antecedentes_medicos" => $antecedentes,
            "motivos_consulta" => $request->get("motivos_consulta"),
            "sintomas" => json_encode($s,JSON_UNESCAPED_UNICODE),
            "diagnostico_doctor" => $request->get("diagnostico_doctor"),
            "paciente" => $request->get("paciente")
        ]);
        $i->save();
        if ($posible_enfermedad) {
            return redirect(route("incidencia.index"))->with("success","Incidencia creada correctamente, el paciente es candidato a COVID-19");
        } else {
            return redirect(route("incidencia.index"))->with("success","Incidencia creada correctamente, el paciente no es candidato a COVID-19");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $incidencia = DB::table('incidencia')
                      ->join('paciente', 'paciente.id', '=', 'incidencia.paciente')
                      ->select("incidencia.*","paciente.nombre AS nombre_paciente")
                      ->where("incidencia.id",$id)
                      ->first();
        $pacientes = Paciente::all();
        $sintomas = ["Tos","Dificultad para respirar","Fiebre","Escalofrios","Temblores y escalofrios que no ceden","Dolor muscular"];
        return view("incidencia.edit",["incidencia"=>$incidencia,"pacientes"=>$pacientes,"sintomas"=>$sintomas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        error_log('No se ha validado aún');
        error_log($request);
        $request->validate([
            "paciente" => "required",
            "nombre_a" => "required",
            "telefono_a" => "required",
            "antecedentes" => "required",
            "Tos" => "required",
            "Dificultad+para+respirar" => "required",
            "Fiebre" => "required",
            "Escalofrios" => "required",
            "Temblores+y+escalofrios+que+no+ceden" => "required",
            "Dolor+muscular" => "required",
            "motivos_consulta" => "required",
            "diagnostico_doctor" => "required"
        ]);
        error_log('Después de validar');
        $sintomas = ["Tos","Dificultad para respirar","Fiebre","Escalofrios","Temblores y escalofrios que no ceden","Dolor muscular"];
        $acompañante = json_encode(array("nombre"=>$request->get("nombre_a"), "telefono"=>$request->get("telefono_a")),JSON_UNESCAPED_UNICODE);
        $antecedentes = $request->get("antecedentes");
        if ($antecedentes == "si") {
            $antecedentes = $request->get("antecedentes-text");
            if ($antecentes == "") {
                $antecedentes = "No";
            }
        } else {
            $antecedentes = "No";
        }
        $s = [];
        $posible_enfermedad = False;
        $cantidad = 0;
        foreach ($sintomas as $sintoma) {
            error_log($sintoma);
            $valor = $request->get(str_replace(" ","+",$sintoma));
            error_log($valor);
            if ($valor == "si") {
                $cantidad = $cantidad + 1;
            }
            $s[$sintoma] = $valor;
        }
        if ($cantidad >= 2 || $s['Tos'] == "si" || $s['Dificultad para respirar'] == "si") {
            $posible_enfermedad = True;
        }
        $i = Incidencia::find($id);
        $i->acompañante = $acompañante;
        $i->antecedentes_medicos = $antecedentes;
        $i->motivos_consulta = $request->get("motivos_consulta");
        $i->sintomas = json_encode($s,JSON_UNESCAPED_UNICODE);
        $i->diagnostico_doctor  = $request->get("diagnostico_doctor");
        $i->paciente = $request->get("paciente");
        $i->save();
        if ($posible_enfermedad) {
            return redirect(route("incidencia.index"))->with("success","Incidencia editada correctamente, el paciente es candidato a COVID-19");
        } else {
            return redirect(route("incidencia.index"))->with("success","Incidencia editada correctamente, el paciente no es candidato a COVID-19");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $incidencia = Incidencia::find($id);
        $incidencia->delete();
        return redirect(route("incidencia.index"))->with("success","Incidencia borrada correctamente");        
    }
}
