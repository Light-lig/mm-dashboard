<?php

namespace App\Http\Controllers;

use App\Models\SmEstados;
use App\Models\SmHabitaciones;
use App\Models\SmMoteles;
use App\Models\SmTipoHabitaciones;
use Illuminate\Http\Request;

class SmHabitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $motel = SmMoteles::find($id);
        $mo_nombre = $motel->mo_nombre;
        $habitaciones = $motel->habitaciones;
        

        return view('habitaciones.index',compact('mo_nombre','habitaciones','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $tipos = SmTipoHabitaciones::all();
        return view('habitaciones.add.add',compact('id','tipos'));
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
        $parametros = $request->all();
        $id = $parametros['mo_id'];
        SmHabitaciones::create($parametros);
        return redirect(route('user.habitacion.index',['id'=>$id]))->with('success', 'Su habitacion fue creada correctamente.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmHabitaciones  $smHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function show(SmHabitaciones $smHabitaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmHabitaciones  $smHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $habitacion = SmHabitaciones::find($id);
        $tipos = SmTipoHabitaciones::all();
        $estados = SmEstados::all();
        error_log(json_encode($estados));
        return view('habitaciones.edit.edit',compact('habitacion','tipos','estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmHabitaciones  $smHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmHabitaciones $smHabitaciones)
    {
        //
        $parametros = $request->except('_token');
        error_log(json_encode($parametros));
        SmHabitaciones::where('ha_id', $parametros['ha_id'])->update($parametros);
        return redirect(route('user.habitacion.index',['id'=>$parametros['mo_id']]))->with('success', 'Su habitacion fue modificada correctamente.');;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmHabitaciones  $smHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $habitacion = SmHabitaciones::find($id);
        $habitacion->delete();
            
        return redirect()->route('user.habitacion.index',["id"=> $habitacion->mo_id])
        ->with('success','Habitacion eliminada con exito.');
    }
    public function allHabitacionesByMotel($id){
        $habitaciones = SmHabitaciones::with('estado')->with('fotos')->where('mo_id',$id)->get();
        return response()->json(['status'=>'success','habitaciones'=>$habitaciones]);
    }
}
