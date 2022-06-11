<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmAccesosUsuarioMoteles extends Model
{
    use HasFactory;

    protected $table = 'sm_accesos_usuario_motel';
    protected $primaryKey = 'acc_id'; 
    protected $fillable = [
        'usr_id',
        'mo_id',
    ];
    public function user(){
        return $this->belongsTo(SmUsuarios::class,'usr_id'.$this->primaryKey);
    }

    public function motel(){
        return $this->belongsTo(SmMoteles::class,'mo_id',$this->primaryKey);
    }
}
