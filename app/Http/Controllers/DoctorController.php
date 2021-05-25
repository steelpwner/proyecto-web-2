<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Hospital;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $doctores = DB::table('doctor')
                      ->join('hospital', 'doctor.hospital', '=', 'hospital.id')
                      ->select("doctor.*","hospital.nombre AS nombre_hospital")
                      ->get();
        return view("doctor.list",["doctores" => $doctores]);
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
        return view("doctor.create", ["hospitales" => $hospitales]);
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
            'nombre_completo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'tipo_sangre' => 'required',
            'años_experiencia' => 'required',
            'fecha_nacimiento' => 'required',
            'hospital' => 'required'
        ]);

        $doctor = new Doctor([
            "nombre_completo" => $request->get("nombre_completo"),
            "direccion" => $request->get("direccion"),
            "telefono" => $request->get("telefono"),
            'tipo_sangre' => $request->get("tipo_sangre"),
            'años_experiencia' => $request->get("años_experiencia"),
            'fecha_nacimiento' => $request->get("fecha_nacimiento"),
            'hospital' => $request->get("hospital")
        ]);

        $doctor->save();

        return redirect(route("doctor.index"))->with("success","¡Doctor creado correctamente!");
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
        $doctor = Doctor::find($id);
        return view("doctor.edit",["doctor" => $doctor, "hospitales" => $hospitales]);
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
            'nombre_completo' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'tipo_sangre' => 'required',
            'años_experiencia' => 'required',
            'fecha_nacimiento' => 'required',
            'hospital' => 'required'
        ]);
        $doctor = Doctor::find($id);
        $doctor->nombre_completo = $request->get("nombre_completo");
        $doctor->direccion = $request->get("direccion");
        $doctor->telefono = $request->get("telefono");
        $doctor->tipo_sangre = $request->get("tipo_sangre");
        $doctor->años_experiencia = $request->get("años_experiencia");
        $doctor->fecha_nacimiento = $request->get("fecha_nacimiento");
        $doctor->hospital = $request->get("hospital");
        $doctor->save();

        return redirect(route("doctor.index"))->with("success","¡Doctor actualizado correctamente!");
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
        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect(route("doctor.index"))->with("success","¡Doctor borrado correctamente!");
    }
}
