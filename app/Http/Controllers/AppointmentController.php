<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Incluimos el modelo Specialty
use App\Specialty;

class AppointmentController extends Controller
{
    public function create()
    {		
    	$specialties = Specialty::all();
    	return view('appointments.create', compact('specialties'));
    }
}
