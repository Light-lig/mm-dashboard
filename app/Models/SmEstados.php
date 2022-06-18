<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmEstados extends Model
{
    use HasFactory;
    protected $primaryKey = "est_id";

    protected $table = 'sm_estado';

}
