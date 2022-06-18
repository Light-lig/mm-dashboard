<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmTipoHabitaciones extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tipo_habitacion'; 
    protected $table = 'sm_tipo_habitacion';
    protected $fillable = [
        'tipo',
        'id_tipo_habitacion',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
    public $incrementing = true;

}
