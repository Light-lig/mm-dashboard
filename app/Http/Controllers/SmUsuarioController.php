<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmUsuarioController extends Controller
{
    //
    use AuthenticatesUsers;

    public function login(Request $request)
    {
       
        $credentials = $request->validate([
            'usr_correo' => ['required', 'email'],
            'password' => ['required'],
        ]);
      

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json(['status'=>'success',"mensaje"=>"Bienvenido.",'user'=>$user]);
        }else{
            return response()->json(['status'=>'failed',"message"=>"Usuario no existe."]);
        }

    }

}
