<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmCategorias extends Model
{
    use HasFactory;

    protected $table = 'sm_categoria';
    protected $primaryKey = 'cat_id';
    protected $fillable = ['cat_tipo'];
    public $timestamps = true;
    public $incrementing = true;

}
