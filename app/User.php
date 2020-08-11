<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','cedula','address','phone', 'role'
    ];

  
    protected $hidden = [
        'password', 'remember_token',
    ];

 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //La función specialties() establece la relación muchos a muchos con el modelo Specialty
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }
    //Query Scopes son consultas que podemos invocar a traves de la función s
    public function scopePatients($query)
    {
        return $query->where('role', 'patient');
    }

    public function scopeDoctors($query)
    {
        return $query->where('role', 'doctor');
    }
}
