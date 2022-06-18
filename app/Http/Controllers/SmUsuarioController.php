<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SmDepartamentos;
use App\Models\Municipality;
use App\Models\SmUsuarios;
class SmUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('user-profile.index');
    }

    public function getProfile(){
        $perfil = Auth::user();
        $departamento = SmDepartamentos::all();
        $municipios = Municipality::all();
         return response()->json(['message' => 'success', 'perfil'=>$perfil,'departamento'=>$departamento,'municipios'=>$municipios]);
    }

    public function getMunicipios($id){
        $mun = Municipality::where('dep_id',$id)->get();
        return response()->json(['message' => 'success', 'municipios'=>$mun]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmUsuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmUsuarios $usuarios)
    {
        SmUsuarios::where('usr_id', $request['usr_id'])->update($request->except(['created_at','updated_at','deleted_at']));
        return response()->json(["message"=>"success"]);
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
    }
}
