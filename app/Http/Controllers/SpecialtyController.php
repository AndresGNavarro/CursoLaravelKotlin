<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;

class SpecialtyController extends Controller
{
	public function __construct()
	//Con el constructor todas la rutas que este controlador resuelvan exigen al usuario que inicie sesión

	{
		$this->middleware('auth');
	}

    public function index()
    //Forma básica de acceder a través de una función a una vista localizada en la carpeta de VIEWS (En el método especificamos la ruta específica)
    {
    	$specialties = Specialty::all();
    	return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
    	return view('specialties.create');
    }
    //La siguiente función contiene las validaciones del los formularios
    private function performValidation(Request $request)
    {
        $rules = [
            'name' => 'required | max:50',
            'description' => 'required | max:50'
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre.',
            'name.max' => 'El máximo de caracteres del nombre ha sido superado.',
            'description.required' => 'Es necesario ingresar una descripción.',
            'description.max' => 'El máximo de caracteres de la descripción ha sido superado.'
        ];
        //Validaciones en la función le pasamos 2 párametros al menos (los datos en request y las reglas de validación, opcionalemente como 3er parámetro incluímos mesage)
        $this->validate($request, $rules, $messages);
    }

    public function store(Request $request)
    {
    	//dd($request->all()); Revisamos los datos
        $this->performValidation($request);

    	$specialty = new Specialty();
    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->save(); //INSERT

        $notification = 'La especialidad se ha registrado correctamente.';
        //Variables inyectadas en un REDIRECT se acceden a través de la variable global de sesión y no de manera directa
    	return redirect('/specialties')->with(compact('notification'));

    }


    public function edit(Specialty $specialty)
    {

    	return view('specialties.edit', compact('specialty'));
    }


    public function update(Request $request, Specialty $specialty)
    {
    	//dd($request->all()); Revisamos los datos
    	$this->performValidation($request);

    	$specialty->name = $request->input('name');
    	$specialty->description = $request->input('description');
    	$specialty->save(); //UPDATE

        $deleteSpecialty = $specialty->name;
        $notification = 'La especialidad '.$deleteSpecialty.' se ha actualizado correctamente.';
    	return redirect('/specialties')->with(compact('notification'));

    }

    public function destroy(Specialty $specialty)
    {
        $deleteSpecialty = $specialty->name;
        $specialty->delete();
        $notification = 'La especialidad '.$deleteSpecialty.' se ha registrado correctamente.';
        return redirect('/specialties')->with(compact('notification'));
    }
}
