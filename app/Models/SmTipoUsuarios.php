<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmTipoUsuarios extends Model
{
    use HasFactory;

    protected $table = "sm_tipo_usuarios";
    protected $primaryKey = "tusr_id";
    protected $fillable = ["tusr_id", "tusr_tipo_usuario"];
    protected $dates = ["updated_at", "deleted_at"];
    public function tipo()
    {
        return $this->hasMany(SmUsuarios::class, $this->primaryKey);
    }
}
