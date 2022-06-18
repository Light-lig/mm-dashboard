<?php

use App\Http\Requests\CategoriaRequest;
use App\Http\Requests\TipoHabitacionesRequest;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\TipoHabitacionesResource;
use App\Models\SmCategorias;
use App\Models\SmTipoHabitaciones;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SmMotelesController;
use App\Http\Controllers\SmUsuarioController;
use App\Http\Controllers\SmHabitacionesController;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\ContraseniaController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['cors','api'])->group(function(){
    Route::controller(SmUsuarioController::class)->group(function(){
        Route::post('/login',  'login');
    });
    Route::controller(SmMotelesController::class)->group(function(){
        Route::get('/moteles/lista',  'allMotels');
    });

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});

Route::get('tipo-habitaciones', function(){
    return TipoHabitacionesResource::collection(SmTipoHabitaciones::paginate(15));
});

Route::get('tipo-habitaciones/{id}', function($id){
    return new TipoHabitacionesResource(SmTipoHabitaciones::find($id));
});

Route::post('tipo-habitaciones', function(TipoHabitacionesRequest $request){
    $tipoHabitaciones = SmTipoHabitaciones::create($request->validated());
    return new TipoHabitacionesResource($tipoHabitaciones);
});

Route::put('tipo-habitaciones/{id}', function(TipoHabitacionesRequest $request, $id){
    $tipoHabitaciones = SmTipoHabitaciones::find($id);
    $tipoHabitaciones->update($request->validated());
    return new TipoHabitacionesResource($tipoHabitaciones);
});

Route::delete('tipo-habitaciones/{id}', function($id){
    $tipoHabitaciones = SmTipoHabitaciones::find($id);
    $tipoHabitaciones->delete();
    return response()->json(['message' => 'Tipo de Habitación eliminado']);
});

Route::get('categorias', function(){
    return CategoriaResource::collection(SmCategorias::paginate(15));
});

Route::get('categorias/{id}', function($id){
    return new CategoriaResource(SmCategorias::find($id));
});

Route::post('categorias', function(CategoriaRequest $request){
    $categorias = SmCategorias::create($request->validated());
    return new CategoriaResource($categorias);
});

Route::put('categorias/{id}', function(CategoriaRequest $request, $id){
    $categorias = SmCategorias::find($id);
    $categorias->update($request->validated());
    return new CategoriaResource($categorias);
});

Route::delete('categorias/{id}', function($id){
    $categorias = SmCategorias::find($id);
    $categorias->delete();
    return response()->json(['message' => 'Categoría eliminada']);
});

Route::apiResource('/user-profile', SmUsuarioController::class);
Route::apiResource('/modifyPassword', ContraseniaController::class);

Route::controller(SmHabitacionesController::class)->group(function(){
    Route::get('/habitaciones/{id}','allHabitacionesByMotel');
});
Route::controller(ReservationController::class)->group(function(){
    Route::get('/reservaciones/{id}','getReservationsByUser');
    Route::post('/reservar','store');
});
});
Route::apiResource("users", UserController::class);
