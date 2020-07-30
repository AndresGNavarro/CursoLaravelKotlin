<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;

class PatientController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::patients()->paginate(5);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
                'role' => 'patient',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'Patient has been created successfully.';
        return redirect('/patients')->with(compact('notification'));
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
    public function edit(User $patient)
    {
        return view('patients.edit', compact('patient'));
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

        $user = User::patients()->findOrFail($id);

        $data = $request->only('name', 'email','cedula','address','phone');
        $password = $request->input('password');
        if ($password) 
            $data['password'] = bcrypt($password);
       
        $user->fill($data);
        $user->save();//UPDATE

        $notification = 'Patient information has been updated successfully.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();
        //Utilizamos comillas dobles para que PHP coloque el valor correspondiente de su variable sin necesidad de hacer una concatenación
        $notification = "El registro del patient $patientName se ha eliminado correctamente.";
        return redirect('/doctors')->with(compact('notification'));
    }
}
