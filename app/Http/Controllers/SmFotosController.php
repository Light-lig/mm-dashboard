<?php

namespace App\Http\Controllers;

use App\Models\SmFotos;
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
    public function index($id)
    {
        //
        $motel = SmMoteles::find($id);
      
        $fotos =    $motel->fotos;
        error_log(json_encode($fotos));
        $mo_nombre = $motel->mo_nombre;
        return view('fotos.index', compact('fotos','mo_nombre','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        return view('fotos.add.add',compact('id'));
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

        if($request->hasFile('fh_foto')){
            if($request->file('fh_foto')->isValid()) {
                try {
                    $file= $request->file('fh_foto');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/moteles'), $filename);
                    $parametre['fh_foto'] = $filename; 
    
                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        }

        SmFotos::create( $parametre );

        return redirect(route('admin.fotos.index',["id"=>$parametre['mo_id']]))->with('success', 'Su foto fue creada correctamente.');;

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
    public function edit($id)
    {
        //
        $foto = SmFotos::find($id);
        return view('fotos.edit.edit', compact('foto'));
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
        if($request->hasFile('fh_foto')){
            if($request->file('fh_foto')->isValid()) {
                try {
                    unlink("public/moteles/".$params['fh_old_foto']);
                    $file= $request->file('fh_foto');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/moteles'), $filename);
                    $params['fh_foto'] = $filename; 
    
                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        }else{
            $params['fh_foto']  = $params['fh_old_foto'];
        }
        error_log($params['fh_old_foto']);
        $foto = SmFotos::find($params['fot_id']);
        $foto->fh_descripcion = $params['fh_descripcion'];
        $foto->fh_foto = $params['fh_foto'];
        $foto->mo_id = $params['mo_id'];

        $foto->update();
        return redirect()->route('admin.fotos.index',["id"=> $params['mo_id']])
        ->with('success','Se actualizo correctamente.');
   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmFotos  $smFotos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $foto = SmFotos::find($id);
        $motel_id = $foto->mo_id;
        unlink("public/moteles/".$foto->fh_foto);
        $foto->delete();

        return redirect()->route('admin.fotos.index',["id"=> $motel_id])
        ->with('success','Foto eliminada con exito.');
    }
}
