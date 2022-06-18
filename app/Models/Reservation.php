<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'sm_reservaciones';
    protected $primaryKey = 'res_id';
    
    public function user(){
        return $this->belongsTo(SmUsuarios::class,'usr_id');
    }

    public function habitacion(){
        return $this->belongsTo(SmHabitaciones::class,'ha_id');
    }
}
