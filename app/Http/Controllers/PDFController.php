<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipoHabitacionesResource;
use App\Models\SmTipoHabitaciones;
use Illuminate\Http\Request;
use PDF;
use Spatie\Permission\Models\Role;

class PDFController extends Controller
{
    public function index()
    {
        $tipoHabitaciones = Role::select('id', 'name', 'created_at', 'updated_at')->with('permissions')->get();
        $data = [
            'title' => 'Tipos de Habitaciones',
            'info' => 'Tipos de Habitaciones del sistema.',
            'tipoHabitacion' => $tipoHabitaciones,
        ];

        /* view()->share('employee', $data['tipos']); */

        $pdf = PDF::loadView('reporte.tipo-habitacion', $data);

        return $pdf->stream();
    }
}
