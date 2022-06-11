<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmFotos extends Model
{
    use HasFactory;

    protected $table = 'sm_fotos';
    protected $primaryKey = 'fot_id'; 
    protected $fillable = [
        'fh_descripcion',
        'fh_foto',
        'ha_id',
        'mo_id',
    ];
    public function motel(){
        return $this->belongsTo(SmMoteles::class,'mo_id',$this->primaryKey);
    }
}
