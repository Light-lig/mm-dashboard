<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class SmUsuarios extends Authenticatable
{
    use HasFactory;

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'sm_usuarios';
    protected $guard = 'admin';
    protected $primaryKey = 'usr_id'; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'usr_correo',
        'usr_password',
        'tusr_id',
        'mun_id',
        'usr_dui',
        'usr_nit',
        'usr_direccion',
        'usr_nombre',
        'usr_apellido',
    ];

    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'usr_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'usr_correo_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->usr_password;
    }
    public function accesos(){
       return  $this->hasMany(SmAccesosUsuarioMoteles::class,'usr_id');
    }

    public function moteles(){
        return  $this->hasManyThrough(SmMoteles::class,SmAccesosUsuarioMoteles::class,
        'usr_id', // Foreign key on the SmAccesosUsuarioMoteles table...
        'mo_id', // Foreign key on the SmMoteles table...
        'usr_id', // Local key on the projects table...
        'mo_id' 
    );

    }
  
}