<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmValoraciones extends Model
{
    use HasFactory;
    protected $primaryKey = 'val_id'; 
    protected $table = 'sm_valoracion';

    public function motel(){
        return $this->belongsTo(SmMoteles::class,'mo_id',$this->primaryKey);
    }
}
