<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SmUsuarios;
use App\Models\Municipality;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("guest");
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            "usr_nombre" => ["required", "string", "max:255"],
            "usr_correo" => [
                "required",
                "string",
                "email",
                "max:255",
                "unique:sm_usuarios",
            ],
            "usr_password" => ["required", "string", "min:8", "confirmed"],
        ]);
    }

    /* public function index()
    {
        if (request()->ajax()) {
            $data = User::select(
                "sm_usuarios.usr_id",
                "sm_usuarios.usr_correo",
                "sm_municipio.mun_nombre"
            )
                ->join(
                    "sm_municipio",
                    "sm_usuarios.mun_id",
                    "=",
                    "sm_municipio.mun_id"
                )
                ->join(
                    "sm_tipo_usuarios",
                    "sm_usuarios.tusr_id",
                    "=",
                    "sm_tipo_usuarios.tusr_id"
                )
                ->get();
            return DataTables::of($data)
                ->addColumn("action", function ($row) {
                    $acciones =
                        '<span class="d-flex justify-content-around">
                        <button type="button" class="btn btn-success btn-sm btnAction" value="Editar.' .
                        $row->id .
                        '"><i class="fas fa-pen text-white"></i></button>
                        <button class="btn btn-danger btn-sm btnAction" value="Eliminar.' .
                        $row->id .
                        '"><i class="far fa-trash-alt text-white"></i></button></span>
                        <span class="d-flex justify-content-around">
                        <button class="btn btn-primary btn-sm btnAction" value="Mostrar.' .
                        $row->id .
                        '"><i class="fas fa-eye text-white"></i></button></span>';
                    return $acciones;
                })
                ->rawColumns(["action"])
                ->make(true);
        }
        $municipalities = Municipality::select("mun_id", "mun_nombre")->get();
        $typeUsers = SmTipoUsuarios::select(
            "tusr_id",
            "tusr_tipo_usuario"
        )->get();
        return view("quote.index", compact("municipalities", "typeUsers"));
    } */

    protected function create(array $data)
    {
        return SmUsuarios::create([
            "usr_nombre" => $data["usr_nombre"],
            "usr_correo" => $data["usr_correo"],
            "usr_password" => Hash::make($data["usr_password"]),
        ]);
    }
}
