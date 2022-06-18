<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmHabitaciones extends Model
{
    use HasFactory;

    protected $table = 'sm_habitacion';
    protected $primaryKey = "ha_id";
    protected $fillable = [
        'ha_descripcion',
        'ha_nombre_habitacion',
        'ha_numero_habitacion',
        'ha_precio',
        'ha_tiempo',
        'ha_id_tipo_de_habitacion',
        'es_id',
        'mo_id',

    ];

    public function estado(){
        return $this->belongsTo(SmEstados::class,'es_id');
    }

    public function tipo(){
        return $this->belongsTo(SmTipoHabitaciones::class,'ha_id_tipo_de_habitacion');
    }

    public function motel(){
        return $this->belongsTo(SmMoteles::class,'mo_id',$this->primaryKey);
    }
    public function fotos(){
        return $this->hasMany(SmFotos::class,$this->primaryKey);
    }

    public function reservaciones(){
        return $this->hasMany(Reservation::class,'ha_id',$this->primaryKey);
    }

}
