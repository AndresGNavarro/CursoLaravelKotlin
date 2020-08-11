<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    private $days = 
    	['Lunes', 'Martes', 'Miércoles','Jueves', 'Viernes','Sábado', 'Domingo'
    	];

    public function edit()
    {

    	
    	//Consulta en la que traemos los horarios(Workdays) del usuario logeado
    	$workDays = WorkDay::where('user_id', auth()->id())->get();
    	//Validamos que haya registros de horarios, caso contrario rellenamos las tablas con valores por default
        if (count($workDays) > 0) {	
    	$workDays->map(function ($workDay)
    	{
    		$workDay->morning_start = (new Carbon($workDay->morning_start))->format('g:i A');
    		$workDay->morning_end = (new Carbon($workDay->morning_end))->format('g:i A');
    		$workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('g:i A');
    		$workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('g:i A');

    		return $workDay;
    	});
            } else {
            $workDays = collect();
            for ($i=0; $i<7; ++$i)
                $workDays->push(new WorkDay());
        }
    	//dd($workDays->toArray());
    	$days = $this->days;
    	//Compact nos permite inyectar variables a la vista
    		return view('schedule', compact('workDays','days'));
    }

    public function store(Request $request)
    {
    	//dd($request->all());
    	//En caso de que Active no existe es reemplazado por un arreglo sin elementos
    	$active = $request->input('active') ?: [];
    	$morning_start = $request->input('morning_start');
    	$morning_end = $request->input('morning_end');
    	$afternoon_start = $request->input('afternoon_start');
    	$afternoon_end = $request->input('afternoon_end');

    	$errors = [];

    	for ($i=0; $i<7; ++$i) {
    	//Validaciones horarios
    		if ($morning_start[$i] > $morning_end[$i]) {
    			$errors[] = 'Las horas del turno mañana son inconsistentes para el día ' .$this->days[$i].'.';
    		}
    		if ($afternoon_start[$i] > $afternoon_end[$i]) {
    			$errors[] = 'Las horas del turno tarde son inconsistentes para el día ' .$this->days[$i].'.';
    		}

    	//UpdateOrCreate revisa si existe o no un registro previo del modelo en la base de datos para realizar la peticion Update o create según sea el caso
		    	WorkDay::updateOrCreate(
		    		[
		    			'day' => $i,
		         		'user_id' => auth()->id(),
		    		],
		    		[
		    			'active' => in_array($i, $active),

				        'morning_start' => $morning_start[$i],
				        'morning_end' => $morning_end[$i],

				        'afternoon_start' => $afternoon_start[$i],
				        'afternoon_end' => $afternoon_end[$i],
		    		]);
		    }
    //Cuando utilizamos return back las variables no se inyectan sobre la vista, si no que se pasan a otra ruta con información que viaja en forma de variables de sessión
		    	if (count($errors) > 0) 
    			return back()->with(compact('errors'));

    		$notification = 'Los cambios se han guardado.';
    		return back()->with(compact('notification'));
    }
}
