<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\SmHabitaciones;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $params = $request->all();
        $idhabitacion = $params['ha_id'];
        $habitacion = SmHabitaciones::find($idhabitacion);
        $habitacion->es_id = 3;
        $habitacion->update();
        $params['fecha'] = date('Y-m-d H:i:s'); 
        $params['hora'] = date('Y-m-d H:i:s');
        Reservation::insert($params);
        return response()->json(['status'=>'success','mensaje'=>'Se reservo correctamente.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function getReservationsByUser($id){
        $reservaciones = Reservation::with('user')->with('habitacion')->where('usr_id',$id)->get();
        return response()->json(['status'=>'success','reservaciones'=>$reservaciones]);
    }
    
}
