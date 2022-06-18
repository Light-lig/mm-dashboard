<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmMoteles extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sm_motel';
    protected $primaryKey = 'mo_id'; 
    protected $fillable = [
        'mo_direccion',
        'mo_foto_portada',
        'mo_latitud',
        'mo_longitud',
        'mo_nombre',
        'cat_id',
        'mun_id',
    ];
    public function accesos(){
        return $this->hasMany(SmAccesosUsuarioMoteles::class);
    }
    public function fotos(){
        return $this->hasMany(SmFotos::class,$this->primaryKey);
    }

    public function habitaciones(){
        return $this->hasMany(SmHabitaciones::class,$this->primaryKey);
    }

    public function valoracion(){
        return $this->hasMany(SmValoraciones::class,$this->primaryKey);
    }

 

}
