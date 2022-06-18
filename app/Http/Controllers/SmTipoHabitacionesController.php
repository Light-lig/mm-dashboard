<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoHabitacionesRequest;
use App\Http\Resources\TipoHabitacionesResource;
use App\Models\SmTipoHabitaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmTipoHabitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoHabitacionesResource::collection(SmTipoHabitaciones::paginate(10));
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
    public function store(TipoHabitacionesRequest $request)
    {
        $type = SmTipoHabitaciones::create($request->validated());
        return new TipoHabitacionesResource($type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmTipoHabitaciones  $smTipoHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function show(SmTipoHabitaciones $smTipoHabitaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmTipoHabitaciones  $smTipoHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(SmTipoHabitaciones $smTipoHabitaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmTipoHabitaciones  $smTipoHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmTipoHabitaciones $smTipoHabitaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmTipoHabitaciones  $smTipoHabitaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmTipoHabitaciones $smTipoHabitaciones)
    {
        //
    }
}
