<?php

namespace App\Http\Controllers;

use App\Models\SmFotos;
use App\Models\SmHabitaciones;
use App\Models\SmMoteles;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

class SmFotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tipo,$id)
    {
        //
        $nombre = '';
        $fotos = [];
        if($tipo=='moteles'){
            $motel = SmMoteles::find($id);
            $nombre = $motel->mo_nombre;
            $fotos = $motel->fotos;
        }else{
            $habitacion = SmHabitaciones::find($id);
            $nombre = $habitacion->ha_nombre_habitacion;
            $fotos = $habitacion->fotos;
        }
        $mo_nombre = $nombre;
        return view('fotos.index', compact('fotos','mo_nombre','id','tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tipo,$id)
    {
        
        return view('fotos.add.add',compact('id','tipo'));
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
        $parametre =$request->all();
        $tipo  = $parametre['tipo'];
        $id_final = 0;
        if($request->hasFile('fh_foto')){
            if($request->file('fh_foto')->isValid()) {
                try {
                    $file= $request->file('fh_foto');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/'.$tipo), $filename);
                    $parametre['fh_foto'] = $filename; 

                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        }
        if($tipo == 'moteles'){
            $parametre['ha_id'] = null;
            $id_final =  $parametre['mo_id'] ;
        }else{
            $parametre['mo_id'] = null;
            $id_final = $parametre['ha_id'] ;
        }
        SmFotos::create($parametre);

        return redirect(route('admin.fotos.index',["id"=>$id_final,'tipo'=>$parametre['tipo']]))->with('success', 'Su foto fue creada correctamente.');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmFotos  $smFotos
     * @return \Illuminate\Http\Response
     */
    public function show(SmFotos $smFotos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmFotos  $smFotos
     * @return \Illuminate\Http\Response
     */
    public function edit($tipo,$id)
    {
        //
        $foto = SmFotos::find($id);
        return view('fotos.edit.edit', compact('foto','tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmFotos  $smFotos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmFotos $smFotos)
    {
        //

        $params =$request->all();
        $tipo  = $params['tipo'];

        $id_final = 0;

        if($request->hasFile('fh_foto')){
            if($request->file('fh_foto')->isValid()) {
                try {
                    unlink("public/".$tipo.'/'.$params['fh_old_foto']);
                    $file= $request->file('fh_foto');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/'.$tipo), $filename);
                    $params['fh_foto'] = $filename; 
    
                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        }else{
            $params['fh_foto']  = $params['fh_old_foto'];
        }
        $foto = SmFotos::find($params['fot_id']);
        $foto->fh_descripcion = $params['fh_descripcion'];
        $foto->fh_foto = $params['fh_foto'];
        $foto->ha_id = null;
        $foto->mo_id = null;
        if($tipo == 'moteles'){
            $id_final =  $params['mo_id'] ;
            $foto->mo_id =  $params['mo_id'] ;

        }else{
            $id_final = $params['ha_id'] ;
            $foto->ha_id = $params['ha_id'];

        }
        

        $foto->update();
        return redirect()->route('admin.fotos.index',["id"=> $id_final,'tipo'=>$params['tipo']])
        ->with('success','Se actualizo correctamente.');
   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmFotos  $smFotos
     * @return \Illuminate\Http\Response
     */
    public function destroy($tipo,$id)
    {
        //
        $mo_id = 0;
        $foto = SmFotos::find($id);
        if($tipo == 'moteles'){
            $mo_id = $foto->mo_id;
        }else{
            $mo_id = $foto->ha_id;
        }

        unlink("public/moteles/".$foto->fh_foto);
        $foto->delete();

        return redirect()->route('admin.fotos.index',["id"=> $mo_id,'tipo'=>$tipo])
        ->with('success','Foto eliminada con exito.');
    }
}
