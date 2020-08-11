@extends('layouts.panel')

@section('content')

     
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Registrar cita</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('patients') }}" class="btn btn-sm btn-default">Cancelar y volver</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
             <div class="card-body">
              <!-- Atrapamos los errores y los iteramos para mostrar cada uno de ellos dentro de un elemento html -->
              @if ($errors->any())
                
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

                  @foreach ($errors->all() as $error)
                  <li> {{$error}}</li>
                  @endforeach
                  
                </div>
              @endif
                  <form action="{{ url('patients') }}" method="post">
                    @csrf

                  <div class="form-group">
                    <label for="especialidad"> Especialidad</label>
                    <select name="" id="" class="form-control">
                      @foreach($specialties as $specialty)
                      <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                      @endforeach
                    </select>
                  </div>
                
                  <div class="form-group">
                    <label for="medico"> Médico</label>
                   <select>
                     
                   </select>
                  </div>

                  <div class="form-group">
                    <label for="fecha"> Fecha</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                          </div>
                          <input class="form-control datepicker" placeholder="Seleccionar fecha" type="text" value="06/20/2020">
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="address"> Hora de atención</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address')}}" >
                  </div>

                  <div class="form-group">
                    <label for="phone"> Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone')}}" >
                  </div>


                  <button type="submit" class="btn btn-primary"> Guardar</button>
                  </form>
                
             </div>
            </div>
          </div>
@endsection

@section('scripts')
  <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
@endsection