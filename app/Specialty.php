<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
	//La función users() establece la relación muchos a muchos con el modelo User
    public function users()
    {
    	 return $this->belongsToMany(User::class);
    }
}
