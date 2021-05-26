<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;
use App\Doctor;
use App\Paciente;
use App\Incidencia;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hospitales = Hospital::all();
        return view("hospital.list", ["hospitales" => $hospitales]);
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
        if (count($hospitales) == 0) {
            return view("hospital.create");
        } else {
            return redirect(route("hospital.index"))->with("error","Ya existe un hospital");
        }
        
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
            'telefono' => 'required|digits:10'
        ]);

        $hospital = new Hospital([
            "nombre" => $request->get("nombre"),
            "direccion" => $request->get("direccion"),
            "telefono" => $request->get("telefono")
        ]);

        $hospital->save();

        return redirect(route("hospital.index"))->with("success","¡Hospital creado correctamente!");
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
        $hospital = Hospital::find($id);
        return view("hospital.edit",["id" => $id, "hospital" => $hospital]);
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
            'telefono' => 'required|digits:10'
        ]);
        $hospital = Hospital::find($id);
        $hospital->nombre = $request->get("nombre");
        $hospital->direccion = $request->get("direccion");
        $hospital->telefono = $request->get("telefono");

        $hospital->save();

        return redirect(route("hospital.index"))->with("success","¡Hospital actualizado correctamente!");
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
        $doctores = Doctor::where("hospital","=",$id)->get();
        foreach ($doctores as $doctor) {
            $doctor->delete();
        }
        $pacientes = Paciente::where("hospital","=",$id)->get();
        foreach ($pacientes as $paciente) {
            $id_p = $paciente->id;
            $incidencias = Incidencia::where("paciente","=",$id_p)->get();
            foreach ($incidencias as $incidencia) {
                $incidencia->delete();
            }
            $paciente->delete();
        }
        $hospital = Hospital::find($id);
        $hospital->delete();
        return redirect(route("hospital.index"))->with("success","¡Hospital borrado correctamente, además de sus pacientes e incidencias, esta acción es irreversible!");
    }
}
