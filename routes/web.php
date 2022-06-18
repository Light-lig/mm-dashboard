<?php

use App\Http\Controllers\AccesosUsuarioMotelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SmFotosController;
use App\Http\Controllers\SmMotelesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmUsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SmHabitacionesController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view("auth.login");
});

Route::controller(LoginController::class)->group(function(){
    Route::post('/user/login', 'authenticate')->name('admin.login');
});

Route::get('/token', function () {
    return response()->json(['token'=>csrf_token()]); 
});
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments');
    Route::get('/municipios', [App\Http\Controllers\MunicipalityController::class, 'index'])->name('municipios');

    Route::controller(AccesosUsuarioMotelController::class)->group(function () {
        Route::get('/accesos-usuarios-motel', 'index')->name('admin.accesos.motel.index');
        Route::get('api/usuarios-by-padre', 'getUsuarios')->name('admin.accesos.motel.usuarios');
        Route::post('api/store-accesos', 'store')->name('admin.accesos.motel.store');
        Route::post('api/destroy-accesos', 'destroy')->name('admin.accesos.motel.destroy');
    });

    Route::controller(SmMotelesController::class)->group(function () {
        Route::get('/motels', 'index')->name('admin.motels.index');
        Route::get('/motels/add', 'create')->name('admin.motels.create');
        Route::post('/motels/store', 'store')->name('admin.motels.store');
        Route::get('/motels/edit/{id}', 'edit')->name('admin.motels.edit');
        Route::post('/motels/update', 'update')->name('admin.motels.update');
        Route::post('/motels/delete/{id}', 'destroy')->name('admin.motels.destroy');
    });
    Route::get('users', function() {
        return view('users.index');
    });
    Route::controller(SmFotosController::class)->group(function () {
        Route::get('/fotos/{id}', 'index')->name('admin.fotos.index');
        Route::get('/fotos/add/{id}', 'create')->name('admin.fotos.create');
        Route::post('/fotos/store', 'store')->name('admin.fotos.store');
        Route::get('/fotos/edit/{id}', 'edit')->name('admin.fotos.edit');
        Route::post('/fotos/update', 'update')->name('admin.fotos.update');
        Route::post('/fotos/delete/{id}', 'destroy')->name('admin.fotos.destroy');
    });

    /* Route::resource('api/room_types', SmTipoHabitacionesController::class); */
    Route::get('/tipoHabitaciones', function () {
        return view('roomtypes.index');
    });

    Route::controller(SmUsuarioController::class)->group(function(){
        Route::get('/user-profile','index')->name('user.profile.index');
        Route::get('api/user-profile','getProfile')->name('user.profile.getProfile');
        Route::get('api/municipios/{id}','getMunicipios')->name('user.profile.getMunicipios');
      
    });

    Route::get('/categorias', function () {
        return view('categoria.index');
    });
    Route::controller(SmFotosController::class)->group(function(){
        Route::get('/fotos/{tipo}/{id}','index')->name('admin.fotos.index');
        Route::get('/fotos/add/{tipo}/{id}','create')->name('admin.fotos.create');
        Route::post('/fotos/store','store')->name('admin.fotos.store');
        Route::get('/fotos/edit/{tipo}/{id}','edit')->name('admin.fotos.edit');
        Route::post('/fotos/update','update')->name('admin.fotos.update');
        Route::post('/fotos/delete/{tipo}/{id}','destroy')->name('admin.fotos.destroy');
    });
    Route::get('/roles', function () {
        return view('rol.index');
    });

    Route::controller(SmHabitacionesController::class)->group(function(){
        Route::get('/habitaciones/{id}','index')->name('user.habitacion.index');
        Route::get('/habitaciones/add/{id}','create')->name('user.habitacion.create');
        Route::post('/habitaciones/store','store')->name('user.habitacion.store');
        Route::get('/habitaciones/edit/{id}','edit')->name('user.habitacion.edit');
        Route::post('/habitaciones/update','update')->name('user.habitacion.update');
        Route::post('/habitaciones/delete/{id}','destroy')->name('user.habitacion.destroy');
    });

    Route::get('api/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('api/roles/{id}', [RoleController::class, 'show'])->name('admin.roles.show');
    Route::post('api/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::put('api/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('api/roles', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
});


Auth::routes();

Route::get('api/permisos', [PermissionController::class, 'index'])->name('admin.permisos.index');

Route::get('reporte/tipo-habitacion', [PDFController::class, 'index'])->name('pdf.index');