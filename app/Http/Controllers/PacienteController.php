<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Hospital;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pacientes = DB::table('paciente')
                      ->join('hospital', 'paciente.hospital', '=', 'hospital.id')
                      ->select("paciente.*","hospital.nombre AS nombre_hospital")
                      ->get();      
        return view("paciente.list",["pacientes"=>$pacientes]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $hospitales = Hospital::all();
        return view("paciente.create",["hospitales"=>$hospitales]);
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
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'eps' => 'required',
            'persona_contacto' => 'required',
            "hospital" => "required"
        ]);

        $paciente = new Paciente([
            "nombre" => $request->get("nombre"),
            "direccion" => $request->get("direccion"),
            "telefono" => $request->get("telefono"),
            "eps" => $request->get("eps"),
            'persona_contacto' => $request->get("persona_contacto"),
            "hospital" => $request->get("hospital")
        ]);

        $paciente->save();

        return redirect(route("paciente.index"))->with("success","¡Paciente creado correctamente!");
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
        $hospitales = Hospital::all();
        $paciente = Paciente::find($id);
        return view("paciente.edit",["hospitales"=>$hospitales,"paciente"=>$paciente]);
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
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'eps' => 'required',
            'persona_contacto' => 'required',
            "hospital" => "required"
        ]);

        $paciente = Paciente::find($id);
        $paciente->nombre = $request->get("nombre");
        $paciente->direccion = $request->get("direccion");
        $paciente->telefono = $request->get("telefono");
        $paciente->eps = $request->get("eps");
        $paciente->persona_contacto = $request->get("persona_contacto");
        $paciente->hospital = $request->get("hospital");
        $paciente->save();
        
        return redirect(route("paciente.index"))->with("success","¡Paciente actualizado correctamente!");
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
        $paciente = Paciente::find($id);
        $paciente->delete();
        return redirect(route("paciente.index"))->with("success","¡Paciente eliminado correctamente!");
    }
}
