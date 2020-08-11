<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//En el siguiente grupo de rutas podemos aplicar diferentes Middlewares para proteger nuestras rutas del sistema y no se pueda acceder sin haber iniciado sesión (La definicion de los Middlewares se encuentra en el archivo Kernel.php)
Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
	//Specialty 
	Route::get('/specialties', 'SpecialtyController@index'); //Index especialidades
	Route::get('/specialties/create', 'SpecialtyController@create'); //Form registro
	Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit'); //Form edit

	Route::post('/specialties', 'SpecialtyController@store'); //Envio del form
	Route::put('/specialties/{specialty}', 'SpecialtyController@update');
	Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');

	//Doctors (En este caso utilazamos rutas de tipo RESOURCE en lugar de declarar todas las rutas como en el caso de Specialty)
	Route::resource('doctors', 'DoctorController');

	//Patients 
	Route::resource('patients', 'PatientController');
     
});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
	Route::get('/schedule', 'ScheduleController@edit');
	Route::post('/schedule', 'ScheduleController@store');

     
});

	Route::get('/appointments/create', 'AppointmentController@create');
	Route::post('/appointments', 'AppointmentController@store');
