<?php

namespace App\Http\Controllers;

use App\Models\SmMoteles;
use App\Models\SmAccesosUsuarioMoteles;
use App\Models\SmCategorias;
use App\Models\SmDepartamentos;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmMotelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $moteles = Auth::user()->moteles;
        
        return view('motels/index', compact('moteles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categorias = SmCategorias::all();
        return view('motels/add/index', compact('categorias'));
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

        if($request->hasFile('mo_foto_portada')){
            if($request->file('mo_foto_portada')->isValid()) {
                try {
                    $file= $request->file('mo_foto_portada');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/moteles'), $filename);
                    $parametre['mo_foto_portada'] = $filename; 
    
                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        }
        $show = SmMoteles::create( $parametre );
        $usrid = Auth::user()->usr_id;
        $acceso = Array('usr_id'=>$usrid,
                        'mo_id'=> $show->mo_id);
        SmAccesosUsuarioMoteles::create($acceso);
        return redirect(route('admin.motels.index'))->with('success', 'Su motel fue creado correctamente.');;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmMoteles  $smMoteles
     * @return \Illuminate\Http\Response
     */
    public function show(SmMoteles $smMoteles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmMoteles  $smMoteles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $motel = SmMoteles::findOrFail($id);
        $categorias = SmCategorias::all();
        $departamentos = SmDepartamentos::all();;
        return view('motels/edit/index',compact('motel','categorias', 'departamentos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SmMoteles  $smMoteles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmMoteles $smMoteles)
    {
        //

        $params =$request->all();
        if($request->hasFile('mo_foto_portada')){
            if($request->file('mo_foto_portada')->isValid()) {
                try {
                    unlink("public/moteles/".$params['mo_old_image']);
                    $file= $request->file('mo_foto_portada');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/moteles'), $filename);
                    $params['mo_foto_portada'] = $filename; 
    
                } catch (FileNotFoundException $e) {
                    echo "catch";
    
                }
            }
        }else{
            $params['mo_foto_portada']  = $params['mo_old_image'];
        }
        $smMoteles = SmMoteles::find($params['mo_id']);
        $smMoteles->mo_nombre = $params['mo_nombre'];
        $smMoteles->mo_foto_portada = $params['mo_foto_portada'];
        $smMoteles->mo_latitud = $params['mo_latitud'];
        $smMoteles->mo_longitud = $params['mo_longitud'];
        $smMoteles->mo_direccion = $params['mo_direccion'];

        $smMoteles->cat_id = $params['cat_id'];
        $smMoteles->mun_id = $params['mun_id'];
     
        $smMoteles->update();

        return redirect()->route('admin.motels.index')
        ->with('success','El motel se actualizo correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmMoteles  $smMoteles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $motel = SmMoteles::find($id);
        $motel->delete();

        return redirect()->route('admin.motels.index')
        ->with('success','Motel eliminado con exito.');
    }
}
