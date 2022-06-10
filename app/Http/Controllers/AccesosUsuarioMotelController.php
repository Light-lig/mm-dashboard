<?php

namespace App\Http\Controllers;

use App\Models\SmAccesosUsuarioMoteles;
use App\Models\SmUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccesosUsuarioMotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('access-motels.index');
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
        try {
            //code...
            $params = $request->all();
            error_log(json_encode($params));
            $accesos = SmAccesosUsuarioMoteles::where('usr_id',$params['usr_id'])->where('mo_id',$params['mo_id'])->get();
            if(sizeof($accesos) == 0){
                SmAccesosUsuarioMoteles::insert($params);
                return response()->json(['status'=>'success',"message"=>"Se agrego permisos correctamente."]);

            }else{
                return response()->json(['status'=>'failed',"message"=>"Ya posee permisos para este recurso."]);
            }

        } catch (\Throwable $th) {
            //throw $th;
            error_log($th->getMessage());
        }
     

        return response()->json(['status'=>'failed',"message"=>"Ocurrio un error interno."]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccesosUsuarioMotel  $accesosUsuarioMotel
     * @return \Illuminate\Http\Response
     */
    public function show(SmAccesosUsuarioMoteles $accesosUsuarioMotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccesosUsuarioMotel  $accesosUsuarioMotel
     * @return \Illuminate\Http\Response
     */
    public function edit(SmAccesosUsuarioMoteles $accesosUsuarioMotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccesosUsuarioMotel  $accesosUsuarioMotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmAccesosUsuarioMoteles $accesosUsuarioMotel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccesosUsuarioMotel  $accesosUsuarioMotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            //code...
            $params = $request->all();
            SmAccesosUsuarioMoteles::where('usr_id',$params['usr_id'])->where('mo_id',$params['mo_id'])->delete();
            return response()->json(['status'=>'success']);

        } catch (\Throwable $th) {
            //throw $th;
            error_log($th->getMessage());
        }
        return response()->json(['status'=>'failed',"message"=>"Ocurrio un error interno."]);

    }

    public function getUsuarios(){
        $user_id = Auth::user()->usr_id;
        $moteles = Auth::user()->moteles;

        $users = SmUsuarios::where('usr_id_padre',$user_id)->get();
        $accesos = SmAccesosUsuarioMoteles::where('usr_id','!=',$user_id)->get();
        return response()->json(['status'=>'success','users'=>$users,'motels'=>$moteles,'accesos'=>$accesos]);
    }

}
