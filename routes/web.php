<?php

use App\Http\Controllers\AccesosUsuarioMotelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SmFotosController;
use App\Http\Controllers\SmMotelesController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);

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

    Route::get('/categorias', function () {
        return view('categoria.index');
    });

    Route::get('/roles', function () {
        return view('rol.index');
    });

});

Route::get('api/roles', [RoleController::class, 'index'])->name('admin.roles.index');
Route::get('api/roles/{id}', [RoleController::class, 'show'])->name('admin.roles.show');
Route::post('api/roles', [RoleController::class, 'store'])->name('admin.roles.store');
Route::put('api/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
Route::delete('api/roles', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

Route::get('api/permisos', [PermissionController::class, 'index'])->name('admin.permisos.index');

Route::get('create-pdf-file', [PDFController::class, 'index'])->name('pdf.index');