<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmUsuarios;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return UserResource::collection(SmUsuarios::paginate(15));
        $role = Role::all();
        $user = SmUsuarios::select(
            "sm_usuarios.usr_id",
            "sm_usuarios.usr_correo",
            "sm_usuarios.usr_role",
            "sm_usuarios.created_at",
            "sm_usuarios.updated_at"
        )->paginate(15);

        return response()->json([
            "message" => "success",
            "role" => $role,
            "user" => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->usr_password = Hash::make($request->usr_password);
        $usuarios = SmUsuarios::create($request->validated())->assignRole(
            $request->usr_role
        );
        return new UserResource($usuarios);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(SmUsuarios::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $usuarios = SmUsuarios::find($id);
        $usuarios->usr_password = Hash::make($usuarios->usr_password);
        $usuarios->syncRoles($request->usr_role);
        $usuarios->update($request->validated());
        return new UserResource($usuarios);
        //error_log(json_encode($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = SmUsuarios::find($id);
        $usuario->delete();
        return response()->json(["message" => "Tipo de usuario eliminado"]);
    }
}
