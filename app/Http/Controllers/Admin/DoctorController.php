<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//Importación de modelos
use App\User;
use App\Specialty;
//Termina importación modelos

use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Aquí hacemos uso de QueryScopes definidos dentro del modelo correspondiente para hacer las consultas necesarias 
        $doctors = User::doctors()->get();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request->all());
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'cedula' => 'nullable|digits:8',
            'address' => 'min:3|max:100',
            'phone' => 'max:20'
        ];

        $this->validate($request,$rules);

        User::create(
            $request->only('name', 'email','cedula','address','phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'Doctor has been created successfully.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'cedula' => 'nullable|digits:8',
            'address' => 'min:3|max:100',
            'phone' => 'max:20'
        ];

        $this->validate($request,$rules);

        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name', 'email','cedula','address','phone');
        $password = $request->input('password');
        if ($password) 
            $data['password'] = bcrypt($password);
       
        $user->fill($data);
        $user->save();//UPDATE

        $notification = 'Doctor information has been updated successfully.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor->delete();
        //Utilizamos comillas dobles para que PHP coloque el valor correspondiente de su variable sin necesidad de hacer una concatenación
        $notification = "El registro del doctor $doctorName se ha eliminado correctamente.";
        return redirect('/doctors')->with(compact('notification'));
    }
}
